<?php

namespace App\Http\Controllers;

use App\Models\Distribucion;
use App\Models\Kardex;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class BandejaController extends Controller
{
    function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:view-bandeja|create-bandeja|edit-bandeja|delete-bandeja', ['only' => ['index','show']]);
        $this->middleware('permission:view-bandeja', ['only' => ['index','show']]);
        $this->middleware('permission:create-bandeja', ['only' => ['create','store']]);
        $this->middleware('permission:edit-bandeja', ['only' => ['edit','update']]);
        $this->middleware('permission:delete-bandeja', ['only' => ['destroy']]);
    }

    public function index()
    {
        $distribucion = Distribucion::all()
                        ->where('organizacion_id', Auth::user()->organizacion_id)
                        ->where('estado_id', '!=', 5);
        $roles = Role::pluck('name')->all();
        return view('bandeja.entrada',compact(['distribucion','roles']));
    }

    public function entrada()
    {
        $distribucion = Distribucion::all()
                        ->where('organizacion_id', Auth::user()->organizacion_id)
                        ->where('estado_id', '!=', 5);
        $roles = Role::pluck('name')->all();
        return view('bandeja.entrada',compact(['distribucion','roles']));
    }

    public function marcarLeido($id)
    {
        //Esta funcion marca como leido el documento por parte del receptor lo anterior, se basa en la distribucion.
        $distribucion = Distribucion::find($id);
        $distribucion->estado_id = 5;
        $distribucion->save();
        //Enviar Notificacion.
        $this->registroKardexEntrada($distribucion->documento->id,Auth::user()->organizacion_id,$distribucion->id);
        Log::info('El usuario ['.Auth::user()->rut.'] ha leido el documento ['.$distribucion->documento->materia->codigo.'/'.$distribucion->documento->num_doc.'].');
    }

    
}
