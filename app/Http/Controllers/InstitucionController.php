<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Institucion;

class InstitucionController extends Controller
{
    public function index()
    {
        $instituciones = Institucion::all();
        return view('institucion.index',compact('instituciones'));
    }

    public function create()
    {
        $titulo = 'Nueva institucion';
        $ubicacion = 'crear institucion';
        return view('institucion.create',compact('titulo','ubicacion'));
    }

    public function store(Request $request)
    {
        $institucion = Institucion::create([
            'sigla'=>$request->sigla,
            'nombre'=>$request->nombre,
            'imagen'=>$request->imagen
        ]);

        return redirect('institucion.index');

    }
}
