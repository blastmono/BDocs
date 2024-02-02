<?php

namespace App\Http\Controllers;

use App\Models\Referencias;
use Illuminate\Http\Request;
use League\CommonMark\Reference\Reference;

class ReferenciasController extends Controller
{
    public function index(){
        $referencias = Referencias::all();
        return view('referencias.index');
    }
}
