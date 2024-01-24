<?php

namespace App\Http\Controllers;

use App\Models\Auditoria;
use Illuminate\Http\Request;

class AuditoriaController extends Controller
{
    public function index(){
        $auditorias = Auditoria::all();
        return view('auditorias.index',compact('auditorias'));
    }
}
