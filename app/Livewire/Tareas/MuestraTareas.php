<?php

namespace App\Livewire\Tareas;

use App\Models\Tareas;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class MuestraTareas extends Component
{
    protected $listeners = ['refreshComponent' => '$refresh'];

    public $documento;
    public $organizacion;

    public function mount($documento)
    {
        $this->documento = $documento;

    }
    public function render()
    {
        $tareas = Tareas::all()
                ->where('documento_id','=',$this->documento)
                ->where('organizacion_id','=',Auth::user()->organizacion_id);
        return view('livewire.tareas.muestra-tareas',compact('tareas'));
    }
}
