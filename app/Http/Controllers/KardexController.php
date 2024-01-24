<?php

namespace App\Http\Controllers;

use App\Events\PublicMessage;
use App\Models\Distribucion;
use App\Models\Documento;
use App\Models\Estado;
use App\Models\Kardex;
use App\Models\Materia;
use App\Models\Organizacion;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Spatie\Permission\Models\Permission;

class KardexController extends Controller
{
    function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:view-kardex|create-kardex|edit-kardex|delete-kardex', ['only' => ['index','show']]);
        $this->middleware('permission:view-kardex', ['only' => ['index','show']]);
        $this->middleware('permission:create-kardex', ['only' => ['create','store']]);
        $this->middleware('permission:edit-kardex', ['only' => ['edit','update']]);
        $this->middleware('permission:delete-kardex', ['only' => ['destroy']]);

    }

    public function index()
    {
        $organizacion = Auth::user()->organizacion_id;

        $kardexs = Kardex::select(
            'kardexes.created_at',
            'kardexes.documento_id',
            'kardexes.destino',
            'kardexes.plazo',
            'kardexes.user_id')
            ->where('kardexes.destino','=',$organizacion)->get();
        $user = Auth::user();
        $ubicacion ='Kardex';
        Log::info('El usuario ['.Auth()->user()->Organizacion->sigla.'/'.Auth()->user()->rut. '] Ha visitado el Kardex Sin Filtros');
        return view('kardex.index',compact('kardexs','user','ubicacion'));
    }

    /*
    Muestra todos los documentos sin importar el destino
    */
    public function todo()
    {
        unset($documentos);

        $organizacion = Auth::user()->organizacion_id;
        $kardexs = Kardex::select(
            'kardexes.created_at',
            'kardexes.documento_id',
            'kardexes.destino',
            'kardexes.plazo',
            'kardexes.user_id')
            ->where('kardexes.destino','=',$organizacion)->get();
        $user = Auth::user();
        Log::info('El usuario ['.Auth()->user()->Organizacion->sigla.'/'.Auth()->user()->rut. '] Ha visitado el Kardex Sin Filtro');
        return view('kardex.todos',compact('kardexs','user'));
    }
    public function entrada()
    {
        $kardex_salida = Kardex::whereIn('id', function ($query) {
                            $query->selectRaw('MAX(id)')
                                ->from('kardexes')
                                ->where('direccion', 1)
                                ->where('org_control', Auth::user()->organizacion_id)
                                ->groupBy('documento_id');
                        })
                        ->get();
        $user = Auth::user();
        $ubicacion = "Kardex Entrada";
        Log::info('El usuario ['.Auth()->user()->Organizacion->sigla.'/'.Auth()->user()->rut. '] Ha visitado el Kardex de Documentos recibidos.');
        event(new PublicMessage('Visita de Kardex','El usuario '.Auth()->user()->rut.' ha visidato el Kardex de documentos entrantes'));
        return view('kardex.index',compact('kardex_salida','user','ubicacion'));
    }

    //Esta funcion obtiene todos los registros del kardex donde se filtran por el ID de la organizacion y la direccion de este documento (SALIDA o ENTRADA)
    public function salida()
    {
        $kardex_salida = Kardex::whereIn('id', function ($query) {
                            $query->selectRaw('MAX(id)')
                                ->from('kardexes')
                                ->where('direccion', 2)
                                ->where('org_control', Auth::user()->organizacion_id)
                                ->groupBy('documento_id');
                        })
                        ->get();
        $user = Auth::user();
        $ubicacion = "Kardex Salida";
        Log::info('El usuario ['.Auth()->user()->Organizacion->sigla.'/'.Auth()->user()->rut. '] Ha visitado el Kardex de Documentos Despachados.');
        event(new PublicMessage('Visita de Kardex','El usuario '.Auth()->user()->rut.' ha visidato el Kardex'));
        return view('kardex.index',compact('kardex_salida','user','ubicacion'));
    }
    public function create()
    {
        $roles = Role::pluck('name')->all();
        $materias = Materia::all();
        $organizaciones = Organizacion::all();
        $usuarios = User::all();
        $estados = Estado::all();
        return view('kardex.create',compact('roles','materias','organizaciones','usuarios','estados'));
    }

    public function store(Request $request)
    {
        if($request->filex){
            $filename = time().'.'.$request->filex->extension(); 
            $request->filex->move(public_path('uploads/kardex/'),$filename);
        }
            $documento = Kardex::create(
                [
                    'direccion' => 1, //1- Recibido; 2- Despachado
                    'fecha_doc' => $request->fecha_doc,
                    'materia_id' => $request->materia_id,
                    'num_doc' => $request->num_doc,
                    'Clasificacion' => $request->clasificacion,
                    'organizacion_id' => $request->organizacion_id, //origen
                    'destino'=>$request->destino, 
                    'tipo_doc'=>$request->tipo_doc,
                    'objeto'=>$request->objeto,
                    'estado_id'=>$request->estado_id,
                    'plazo'=>$request->plazo,
                    'cumplido'=>($request->cumplido == 'on') ? 1 : 0,
                    'user_id'=> Auth::id(),
                    'entregado'=>($request->entregado == 'on') ? 1 : 0,
                    'papel'=>($request->papel == 'on') ? 1 : 0,
                    'archivador' => $request->archivador,
                    'originador' => $request->originador,
                    'copia' => ($request->copia == 'on') ? 1 : 0,
                    'org_control' => Auth::user()->organizacion_id,
                    'ruta_digital' => $filename,
                ]
            );
            Log::info('El usuario ['.Auth()->user()->Organizacion->sigla.']'.Auth()->user()->rut. ' Ha registrado documento');
            //DB::select('call auditorias(?,?)',array($request->rut_user,'Ingresa documento['.$request->materia_id.'/'.$request->num_doc.'] al Kardex.'));
            return redirect('kardex.index');
    }

    public function show($id)
    {
        $documento = Kardex::find($id);
        $materia = Materia::find($documento['materia_id']);
        $fondo_clasificacion="";
        if($documento['Clasificacion']=='SECRETO'){
            $fondo_clasificacion = 'bg-danger';
        }elseif($documento['Clasificacion']=='RESERVADO'){
            $fondo_clasificacion = 'bg-warning';
        }else{
            $fondo_clasificacion = 'bg-primary';
        }
        return view('kardex.show',compact(['documento','materia','fondo_clasificacion']));
    }

}
