<?php

namespace App\Http\Controllers;

use App\Events\OrganizationMessage;
use App\Events\PrivateMessage;
use App\Models\Distribucion;
use Illuminate\Http\Request;
use App\Models\Documento;
use App\Models\Estado;
use App\Models\Kardex;
use App\Models\Materia;
use App\Models\Organizacion;
use App\Models\Referencias;
use App\Models\User;
use App\Models\Seguimiento;
use App\Models\tipoDocumento;
use App\Models\tipoTramite;
use App\Notifications\NotificarCambios;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;
use Spatie\Permission\Models\Role;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Storage;

class DocumentoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:view-document|create-document|edit-document|delete-document',['only' => ['index','show']]);
        $this->middleware('permission:view-document', ['only' => ['index','show']]);
        $this->middleware('permission:create-document', ['only' => ['create','store']]);
        $this->middleware('permission:edit-document', ['only' => ['edit','update']]);
        $this->middleware('permission:delete-document', ['only' => ['destroy']]);
    }
          
    /*
    Esta funcion es solo para auditorias ya que muestra TODOS los documentos que estan en la base de datos.
    */
    public function index(){
        
        $documentos = DB::table('documentos')
                    ->select(
                        'documentos.id',
                        'materias.codigo',
                        'documentos.fecha_doc',
                        'documentos.num_doc',
                        'documentos.clasificacion',
                        'documentos.objeto',
                        'documentos.organizacion_id',
                        'organizacions.sigla',
                        'documentos.prefijo',
                        'documentos.ejemplares',
                        'tipo_documentos.nombre'
                    )
                    ->leftJoin('organizacions', 'organizacions.id', '=', 'documentos.organizacion_id')
                    ->leftJoin('tipo_documentos', 'tipo_documentos.id', '=', 'documentos.tipo_documento_id')
                    ->leftJoin('materias', 'materias.id', '=', 'documentos.materia_id')
                    ->where('documentos.organizacion_id', '=', Auth::user()->organizacion_id)
                    ->where('documentos.enviado','=',0)
                    ->get();
        $roles = Role::pluck('name')->all();
        return view('documentos.index',compact('documentos','roles'));
    }

    public function create(){
        $materias = Materia::all();
        $organizaciones = Organizacion::all();
        $usuarios = User::all();
        $roles = Role::pluck('name')->all();
        $estados = Estado::all();
        $tipoDoc = tipoDocumento::all();
        $tipoTra = tipoTramite::all();
        $referencias = Documento::all();
        
        return view('documentos.create',compact(
                    'materias',
                    'organizaciones',
                    'usuarios',
                    'roles',
                    'estados',
                    'tipoDoc',
                    'tipoTra',
                    'referencias',
                ));
    }

    public function store(Request $request)
    {
        try{
            $archivo = $request->file;
            $filename = time().'.'.$request->file->extension();
            $contenido = file_get_contents($archivo);
            $path = Storage::disk('minio')->put($filename,$contenido);
            //Agrega el documento al sistema
            Documento::create([
                'materia_id' => $request->materia_id,
                'num_doc' => $request->num_doc,
                'clasificacion' => $request->clasificacion,
                'fecha_doc' => $request->fecha_doc,
                'objeto' => $request->objeto,
                'organizacion_id'=> Auth()->user()->Organizacion->id,
                'tipo_documento_id'=> $request->tipo_documento_id,
                'prefijo'=>$request->prefijo,
                'ejemplares'=> $request->ejemplares,
                'hojas'=>$request->hojas,
                'tipo_tramite_id'=>$request->tipo_tramite_id,
                'user_id'=> $request->firmante,
                'impreso'=>($request->papel == 'on') ? 1 : 0,
                'rutaArchivo'=>$filename
            ]);
        }catch(Exception $ex){
            Log::critical($ex);
        }
        
        $mensajeFinal = 'El usuario ['.Auth()->user()->Organizacion->sigla.'/'.Auth()->user()->rut. ']
                     Ha ingresado el documento['.$request->num_doc.']';
        event(new PrivateMessage(Auth::user(),'Documento Registrado','El Documento ha sido ingresado con exito.'));
        Log::info($mensajeFinal);
        return redirect('dashboard')->with('Documento agregado con exito.');
    }

    public function show($id, $dist = null){
        if($dist != null)
        {
            $this->marcarLeido($dist);
        }
        
        $historia = Seguimiento::all();
        $documento = Documento::find($id);
        $materia = Materia::find($documento['materia_id']);
        $organizacion = Organizacion::find($documento['organizacion_id']);
        $distribucion = Distribucion::all()->where('documento_id','=',$id);
        $fondo_clasificacion="";
        if($documento['clasificacion']=='SECRETO'){
            $fondo_clasificacion = 'bg-red';
        }elseif($documento['clasificacion']=='RESERVADO'){
            $fondo_clasificacion = 'bg-warning';
        }else{
            $fondo_clasificacion = 'bg-primary';
        }
        Log::info('El usuario ['.Auth()->user()->Organizacion->sigla.'/'.Auth()->user()->rut. ']
                    Ha visto el documento['.$documento->materia->codigo.'/'.$documento->num_doc.']');
        return view('documentos.show',compact(
                        'documento',
                        'materia',
                        'organizacion',
                        'fondo_clasificacion',
                        'historia',
                        'distribucion'
                    ));
    }

    /** Esta funcion obtiene los documentos que estan asignados a una persona en especifico. Bandeja de entrada */
    public function bandeja($id){
        $documentos = DB::table('distribucions')
                        ->leftJoin('documentos','documentos.id','=','distribucions.documento_id')
                        ->leftJoin('organizacions','organizacions.id','=','distribucions.organizacion_id')
                        ->where(
                            'distribucions.user_id','=',auth()->user()->id)
                            ->get(['distribucions.*','organizacions.sigla']);
        $roles = Role::pluck('name')->all();
        Log::info('El usuario ['.Auth()->user()->Organizacion->sigla.'/'.Auth()->user()->rut. '] Ha ingresado a la Bandeja');
        return view('documentos.index',compact('documentos','roles'));
    }

    public function destroy($doc)
    {
        $documento = Documento::find($doc);
        $documento->delete();
        Log::alert('El usuario ['.Auth()->user()->Organizacion->sigla.'/'.Auth()->user()->rut. '] Ha borrado un documento [ID: '.$documento->id.']' );
        return redirect()->route('documentos.index')->withSuccess('El documento ha sido eliminado correctamente.');

    }

    public function marcarLeido($id)
    {
        //Esta funcion marca como leido el documento por parte del receptor lo anterior, se basa en la distribucion.
        $distribucion = Distribucion::find($id);
        if($distribucion->estado_id != 5){
            $distribucion->estado_id = 5;
            $distribucion->save();
            $this->registroKardexEntrada($distribucion->documento_id);
            //Enviar Notificacion.
            event(new OrganizationMessage(Auth::user(),
                    "Lectura de Documento","El usuario: ".Auth::user()->rut." ha leido el documento,
                     [".$distribucion->documento->materia->codigo."/".$distribucion->documento->num_doc."]"));
        }
        Log::info('El usuario ['.Auth::user()->rut.'] ha leido el documento ['.$distribucion->documento->materia->codigo.'/'.$distribucion->documento->num_doc.'].');
    }

    public function enviarNotificacion()
    {
        $esquema = Documento::all();

        $notificacion = [
            'titulo'=>' Se agrego un nuevo documento',
            'contenido'=>'se ha almacenado un nuevo documento al sistema.'
        ];

        Notification::Send($esquema, new NotificarCambios($notificacion));
        dd('Tarea Realizada');
    }
    public function registroKardexEntrada($id_doc)
    {
        try{
            $distribucion = Distribucion::all()->where('documento_id',$id_doc)->first();
            Kardex::create([
                'direccion'=>1,
                'documento_id' => $id_doc,
                'organizacion_id'=> $distribucion->organizacion_id,
                'estado_id'=>$distribucion->estado_id, //obtener dato desde tabla seguimiento
                'user_id'=>Auth::user()->id,
                'originador'=>Auth::user()->id,
                'org_control'=>Auth::user()->organizacion_id,
                'entregado'=>1,
                'distribucion_id'=>$distribucion->id,
            ]);
            Log::info('El documento fue registrado en el Kardex de Entrada.');
        }
        catch(Exception $ex)
        {
            Log::critical('El documento no pudo ser registrado en el KARDEX de ENTRADA.' .$ex);
        }
    }

    public function buscar(Request $request)
    {
        //Separa el codigo de la materia
        $elementos = explode('/',$request->documento);
        //obtiene la ID de la materia a buscar
        $materia = Materia::select('id')->where('codigo',$elementos[0]);
        //se obtiene el documento en base al id del documento y el numero del documento propiamente tal
        $documento = Documento::select('id')->where('materia_id',$materia)->where('num_doc',$elementos[1])->first();
            $this->show($documento);
        
        //obtenido los datos se ejecuta la vista
        
    }
}
