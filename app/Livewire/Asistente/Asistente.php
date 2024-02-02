<?php

namespace App\Livewire\Asistente;

use App\Models\Documento;
use App\Models\Estado;
use App\Models\Materia;
use App\Models\Organizacion;
use App\Models\tipoDocumento;
use App\Models\tipoTramite;
use App\Models\User;
use Livewire\Component;

class Asistente extends Component
{
    public $currentStep = 1;
    public $materia_id;
    public $num_doc;
    public $clasificacion;
    public $fecha_doc;
    public $objeto;
    public $origen;
    public $organizacion_id;//Destino
    public $copiaInf; //C/I
    public $tipo_documento_id;
    public $ejemplares;
    public $hojas;
    public $tipo_tramite_id;
    public $user_id;
    public $rutaArchivo;
    public $enviado;
    public $cuerpo;
    public $successMsg='';


    public function render()
    {
        $materias = Materia::all();
        $organizaciones = Organizacion::all();
        $usuarios = User::all();
        $estados = Estado::all();
        $tipoDoc = tipoDocumento::all();
        $tipoTra = tipoTramite::all();
        $referencias = Documento::all();
        return view('livewire.asistente.asistente',compact('materias','organizaciones','usuarios','estados','tipoDoc','tipoTra','referencias'));
    }

    public function firstStepSubmit()
    {
        /*$validateData = $this->validate([
            'clasificacion'=>['required'],
            'ejemplares'=>['required'],
            'hojas'=>['required']
        ]);*/

        $this->currentStep = 2;
    }

    public function secondStepSubmit()
    {
        /*$validateData = $this->validate([
            'tipo_tramite_id'=>['required'],
            'fecha_doc'=>['required'],
            'materia_id'=>['required'],
        ]);*/
        $this->currentStep = 3;
    }

    public function thirdStepSubmit()
    {
        
        $this->currentStep = 4;
    }
    public function fourStepSubmit()
    {
        
        $this->currentStep = 5;
    }

    public function submitForm()
    {
        //Digital::create();
        $this->successMsg="Documento creado correctamente";
        $this->clearForm();
        $this->currentStep=1;
    }

    public function back($step)
    {
        $this->currentStep= $step;
    }

    public function clearForm()
    {
        $this->materia_id ='';
        $this->num_doc;
        $this->clasificacion;
        $this->fecha_doc;
        $this->objeto;
        $this->organizacion_id;
        $this->tipo_documento_id;
        $this->ejemplares;
        $this->hojas;
        $this->tipo_tramite_id;
        $this->user_id;
        $this->rutaArchivo;
        $this->enviado;
        $this->cuerpo;
    }
}
