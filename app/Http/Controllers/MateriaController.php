<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Materia;

class MateriaController extends Controller
{
    public function index(){
        $materias = Materia::all();
        return view('materias.index', compact('materias'));
    }
}
