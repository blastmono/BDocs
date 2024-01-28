<?php

namespace App\Http\Controllers;

use App\Events\OrganizationMessage;
use Illuminate\Http\Request;
use App\Models\Distribucion;
use App\Models\Documento;
use App\Models\Estado;
use App\Models\Kardex;
use App\Models\Organizacion;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Spatie\Permission\Models\Role;

class DistribucionController extends Controller
{
    function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:view-distribucion|create-distribucion|edit-distribucion|delete-distribucion', ['only' => ['index','show']]);
        $this->middleware('permission:view-distribucion', ['only' => ['index','show']]);
        $this->middleware('permission:create-distribucion', ['only' => ['create','store']]);
        $this->middleware('permission:edit-distribucion', ['only' => ['edit','update']]);
        $this->middleware('permission:delete-distribucion', ['only' => ['destroy']]);

    }
    public function index()
    {
        //Todos los mensajes distribuidos
        $distribuciones = Distribucion::all();
        $roles = Role::pluck('name')->all();
        //DB::select('call auditorias(?,?)',array(auth()->user()->rut,'Ingresa a la distribucion. [SOLO VISTA]'));
        Log::info('['.Auth()->user()->Organizacion->sigla.'/'.Auth()->user()->rut. '] - Ingresa a la Distribucion de documentos.');
        return view('distribucions.index',compact('distribuciones','roles'));
    }

    public function create($doc)
    {
        /*$documentos = $documentos = DB::table('documentos')
        ->leftJoin('materias','materias.id','=','documentos.materia_id')
        ->leftJoin('organizacions','organizacions.id','=','documentos.organizacion_id')->get(['documentos.*','materias.codigo','organizacions.sigla']);*/
        //$documentos = Documento::all()->where('id','=',$doc);
        $documentos = Documento::select('documentos.*', 'materias.codigo', 'organizacions.sigla')
                    ->leftJoin('materias', 'materias.id', '=', 'documentos.materia_id')
                    ->leftJoin('organizacions', 'organizacions.id', '=', 'documentos.organizacion_id')
                    ->where('documentos.id', $doc)
                    ->get();
        $organizaciones = Organizacion::all();
        $estados = Estado::all();
        $usuarios = User::all();
        $role = Role::pluck('name')->all();

        return view('distribucions.create',compact('role','documentos','organizaciones','estados','usuarios'));
    }

    public function store(Request $request)
    {
        //Despacha el Documento
        $i=0;
        $destinos = $request->organizacion_id;
        try
        {
            if(count($destinos) > 1){
                foreach($destinos as $destino)
                {
                    $distribucion = Distribucion::create([
                    'origen'=> Auth::user()->organizacion->id,
                    'documento_id' => $request->documento_id,
                    'organizacion_id'=>$destino,
                    'estado_id'=>1,
                    'ejemplar'=> $i,
                    'user_id'=>$request->user_id
                    ]);
                    $dist_id = Distribucion::latest('id')->first()->id;
                    $this->registroKardexSalida($request->documento_id,$destino,$dist_id);
                }
                $documento = Documento::find($request->documento_id);
                $documento->enviado = 1;
                $documento->save();

            }else{
                $distribucion = Distribucion::create([
                    'origen'=>Auth::user()->organizacion->id,
                    'documento_id' => $request->documento_id,
                    'organizacion_id'=>$request->organizacion_id[0],
                    'estado_id'=>1,
                    'ejemplar'=> 1,
                    'user_id'=>$request->user_id
                ]);
                $dist_id = Distribucion::latest('id')->first()->id;
                $this->registroKardexSalida($request->documento_id,$request->organizacion_id,$dist_id);
                $documento = Documento::find($request->documento_id);
                $documento->enviado = 1;
                $documento->save();
            }
        }catch(Exception $ex)
        {
            Log::critical('Error en el proceso de almacenado de KARDEX de salida.'. $ex);
        }
        event(new OrganizationMessage(Auth::user(),'Documento Despachado','Nuevo documento despachado desde.'.Auth::user()->organizacion->nombre));
        //Registra en Kardex de salida
        Log::info('['.Auth()->user()->Organizacion->sigla.'/'.Auth()->user()->rut. '] - Despacha el Documento.');
        return redirect('dashboard');
    }

    public function show()
    {}

    /**Esta funcion registra automaticamente un documento en el kardex de salida */
    public function registroKardexSalida($id_doc,$destino,$dist_id)
    {
        try{
            $distribucion = Distribucion::all()->where('documento_id',$id_doc)->first();

            $kardex = Kardex::create([
                'direccion'=>2,
                'documento_id' => $id_doc,
                'organizacion_id'=> $destino,
                'estado_id'=>1, //obtener dato desde tabla seguimiento
                'user_id'=>Auth::user()->id,
                'originador'=>Auth::user()->id,
                'org_control'=>Auth::user()->organizacion_id,
                'entregado'=>1,
                'distribucion_id'=>$dist_id,
            ]);
        }
        catch(Exception $ex)
        {
            Log::critical('El documento no pudo ser registrado en el KARDEX de Salida.' .$ex);
        }
    }
    public function registroKardexEntrada($id_doc,$destino,$dist_id)
    {
        try{
            $distribucion = Distribucion::all()->where('documento_id',$id_doc)->first();

            $kardex = Kardex::create([
                'direccion'=>2,
                'documento_id' => $id_doc,
                'organizacion_id'=> $destino,
                'estado_id'=>1, //obtener dato desde tabla seguimiento
                'user_id'=>Auth::user()->id,
                'originador'=>Auth::user()->id,
                'org_control'=>Auth::user()->organizacion_id,
                'entregado'=>1,
                'distribucion_id'=>$dist_id,
            ]);
        }
        catch(Exception $ex)
        {
            Log::critical('El documento no pudo ser registrado en el KARDEX de Salida.' .$ex);
        }
    }
}
