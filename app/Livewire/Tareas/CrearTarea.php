<?php

namespace App\Livewire\Tareas;

use App\Models\Documento;
use App\Models\Organizacion;
use App\Models\Tareas;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class CrearTarea extends Component
{
    

    public $docId= ""; //trae desde el documento abierto
    public $docu = "";
    public $usuario;
    public $organizacionId="";
    public $responsable="";
    public $tarea;
    public $detalle;
    public $completada;
    public $plazo;

    public function mount($docu = null,$organizacion_id = null)
    {
        $this->docu = $docu;
    }

    public function save(){
        Tareas::create([
            'documento_id'=> $this->docu,
            'user_id'=>$this->responsable,
            'organizacion_id'=>Auth::user()->organizacion_id,
            'responsable'=>Auth::user()->id,
            'tarea'=>$this->tarea,
            'detalle' => $this->detalle,
            'completada' => ($this->completada == 'cheked') ? 1 : 0,
            'plazo'=>$this->plazo,
        ]);
        $this->reset();

    }

    public function render()
    {
        $docu = Documento::all()->where('id','=',$this->docu);
        $organizacion = Organizacion::find(Auth::user()->organizacionId);
        $user_id = Auth::user()->id;
        $usuarios = User::all()->where('organizacion_id','=',Auth::user()->organizacion_id);
        return view('livewire.tareas.crear-tarea',compact('docu','organizacion','user_id','usuarios'));
    }
}
