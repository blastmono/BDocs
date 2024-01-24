<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Estado;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class EstadoController extends Controller
{
    function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:view-estado|create-estado|edit-estado|delete-estado', ['only' => ['index','show']]);
        $this->middleware('permission:view-estado', ['only' => ['index','show']]);
        $this->middleware('permission:create-estado', ['only' => ['create','store']]);
        $this->middleware('permission:edit-estado', ['only' => ['edit','update']]);
        $this->middleware('permission:delete-estado', ['only' => ['destroy']]);
    }

    //Lista los estados
    public function index(){
        $estados = Estado::all();
        return view('estados.index',compact('estados'));
    }

    //Crea un Estado
    public function create(){
        return view('estados.create');
    }

    //Store 
    public function store(Request $request){
        $estado = Estado::create([
            'nombre' =>$request->nombre,
            'descripcion' => $request->descripcion,
            'activo'=> $request->activo
        ]);

        //registro en la auditoria
        //DB::select('call auditorias(?,?)',array($request->user_id,'Se crea Estado en plataforma.'));
        Log::info('['.Auth()->user()->Organizacion->sigla.'/'.Auth()->user()->rut. '] - Crea estado de documento en la Plataforma.');
        return redirect('estados.index');
    }
    
}
