<?php

namespace App\Http\Controllers;

use App\Models\Anuncio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AnuncioController extends Controller
{
    public function index()
    {
        $anuncios = Anuncio::all();
        return view('anuncios.index',compact('anuncios'));
    }

    public function anuncios_organizacion()
    {
        $anuncios = Anuncio::all()->where('organizacion_id',Auth::user()->organizacion_id);
        return view('anuncios.index',compact('anuncios'));
    }

    public function anuncios_usuario()
    {
        $anuncios = Anuncio::all()->where('organizacion_id',Auth::user()->id);
        return view('anuncios.index',compact('anuncios'));
    }
}
