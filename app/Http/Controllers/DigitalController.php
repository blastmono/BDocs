<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DigitalController extends Controller
{
    public function create(){
        return view('digitals.create');
    }
}
