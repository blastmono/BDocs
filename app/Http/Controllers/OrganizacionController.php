<?php

namespace App\Http\Controllers;

use App\Models\Materia;
use Illuminate\Http\Request;
use App\Models\Organizacion;
use stdClass;

class OrganizacionController extends Controller
{
    public function index()
    {
        $organizaciones = Organizacion::all();
        $structuredData = [];
        foreach ($organizaciones as $item) {
            $structuredData[] = [
                'id' => $item['id'],
                'parent' => $item['organizacion_id'],
                'name' => $item['nombre'],
                'sigla' =>$item['sigla'],
            ];
        }
        $structuredData[0]['parent']=null;
        return view('organizacion.index', compact('organizaciones','structuredData'));
    }

    public function create()
    {
        $titulo = 'Agregar Organizacion';
        $organizaciones = Organizacion::all();
        return view('organizacion.create', compact('titulo','organizaciones'));
    }

    public function store(Request $request)
    {
        Organizacion::create([
            'sigla'=> $request->sigla,
            'nombre'=> $request->nombre,
            'organizacion_id' => $request->organizacion_id,
        ]);
        return redirect()->route('organizacion.index');
    }

    public function show(Organizacion $organizacion)
    {
        $superior = Organizacion::find($organizacion['organizacion_id']);
        return view('organizacion.show',compact('organizacion','superior'));
    }

    public function edit(Organizacion $organizacion)
    {
        return view('organizacion.edit',compact('organizacion'));
    }
}
