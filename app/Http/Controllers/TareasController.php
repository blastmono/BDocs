<?php

namespace App\Http\Controllers;

use App\Models\Tareas;
use Illuminate\Http\Request;

class TareasController extends Controller
{
    function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:view-tareas|create-tareas|edit-tareas|delete-tareas', ['only' => ['index','show']]);
        $this->middleware('permission:view-tareas', ['only' => ['index','show']]);
        $this->middleware('permission:create-tareas', ['only' => ['create','store']]);
        $this->middleware('permission:edit-tareas', ['only' => ['edit','update']]);
        $this->middleware('permission:delete-tareas', ['only' => ['destroy']]);
    }

    public function index()
    {
        //obtiene TODAS las tareas registadas en el sistema
        $tareas = Tareas::all();
        return view('tareas.index',compact('tareas'));
    }
    
}
