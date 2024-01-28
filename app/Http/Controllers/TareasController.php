<?php

namespace App\Http\Controllers;

use App\Events\OrganizationMessage;
use App\Events\PrivateMessage;
use App\Models\Tareas;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class TareasController extends Controller
{
    function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:view-tareas|create-tareas|edit-tareas|delete-tareas|cumple-tareas', ['only' => ['index','show']]);
        $this->middleware('permission:view-tareas', ['only' => ['index','show']]);
        $this->middleware('permission:create-tareas', ['only' => ['create','store']]);
        $this->middleware('permission:edit-tareas', ['only' => ['edit','update']]);
        $this->middleware('permission:delete-tareas', ['only' => ['destroy']]);
        $this->middleware('permission:cumple-tareas', ['only' => ['cumple']]);

    }

    public function index()
    {
        //obtiene TODAS las tareas registadas en el sistema
        //tareas asignadas al usuario
        $tareas = Tareas::all()->where('user_id',Auth::user()->id);
        //tareas que ha asignado el usuario
        $tareas_asignadas = Tareas::all()->where('responsable',Auth::user()->id);
        return view('tareas.index',compact('tareas','tareas_asignadas'));
    }

    public function cumple($id){
        $tarea = Tareas::find($id);
        try{
            if($tarea->completada != '1'){
            $tarea->completada = 1;
            $tarea->save();
            }
            event(new OrganizationMessage(Auth::user(),'Cumplimiento de Tarea '.$tarea->tarea,'Cumplimiento de Tarea informado'));
            Log::info("cumplimiento de tarea ".$tarea->id);
            return redirect(route('tareas.index'));
        }catch(Exception $ex){
            Log::critical('Ha ocurrido un error [Modulo: Tareas] '.$ex);
        }
        
    }
    
}
