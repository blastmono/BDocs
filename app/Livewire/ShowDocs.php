<?php

namespace App\Livewire;

use Illuminate\Session\SessionManager;
use Livewire\Component;

class ShowDocs extends Component
{
    public $materia;
    public $objeto;

    public function render()
    {
        return view('livewire.show-docs')->extends('layouts.tabler')->section('content');
    }
}
