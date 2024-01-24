<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\categoriaMateria;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CategoriaMateriaController extends Controller
{
    public function index(){
        $categoriasMaterias = categoriaMateria::all();
        return view('tipoMaterias.index',compact('categoriasMaterias'));
    }

    public function create()
    {
        return view('tipoMaterias.create');
    }

    public function store(Request $request)
    {
        categoriaMateria::create([
            'codigo'=>$request->codigo,
            'descripcion'=>$request->descripcion
        ]);
        Log::info('['.Auth()->user()->Organizacion->sigla.'/'.Auth()->user()->rut. '] - Crea Materia en la plataforma.');
        return redirect()->route('tipoMaterias.index');
    }
}
