<div>
    <div class="container">
        <div class="card">
            <div class="card-header"></div>
            <div class="card-body">
                    @if(!empty($successMsg))
        <div class="alert alert-success">
            {{$successMsg}}
        </div>
    @endif
    <div class="stepwizard">
        <div class="stepwizard-row setup-panel">
            <div class="multi-wizard-step">
                <a href="#step-1" type="button"
                    class="btn {{ $currentStep != 1 ? 'btn-default' : 'btn-primary' }}">1</a>
                <p>Paso 1</p>
            </div>
            <div class="multi-wizard-step">
                <a href="#step-2" type="button"
                    class="btn {{ $currentStep != 2 ? 'btn-default' : 'btn-primary' }}">2</a>
                <p>Paso 2</p>
            </div>
            <div class="multi-wizard-step">
                <a href="#step-3" type="button"
                    class="btn {{ $currentStep != 3 ? 'btn-default' : 'btn-primary' }}"
                    disabled="disabled">3</a>
                <p>Paso 3</p>
            </div>
            <div class="multi-wizard-step">
                <a href="#step-2" type="button"
                    class="btn {{ $currentStep != 4 ? 'btn-default' : 'btn-primary' }}">4</a>
                <p>Paso 4</p>
            </div>
            <div class="multi-wizard-step">
                <a href="#step-2" type="button"
                    class="btn {{ $currentStep != 5 ? 'btn-default' : 'btn-danger' }}">5</a>
                <p>Paso 5</p>
            </div>
        </div>
    </div>
    <div class="row setup-content {{ $currentStep != 1 ? 'display-none' : '' }}" id="step-1">
        <div class="col-md-12">
            <h3> Paso 1: Identificacion del Documento</h3>
            <div class="form-group">
                <label for="tarea">Clasificacion</label>
                <select class="form-select js-basic-sel2" wire:model="clasificacion" aria-label="Default select example" id="clasificacion" name="clasificacion">
                    <option selected>Seleccione Opcion</option>
                    <option value="PUBLICO">PUBLICO</option>
                    <option value="RESERVADO">RESERVADO</option>
                    <option value="SECRETO">SECRETO</option>
                </select>
                @error('clasificacion') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="form-group">
                <label for="description">Ejemplares:</label>
                <input type="text" wire:model="ejemplares" class="form-control" id="ejemplares" />
                @error('ejemplares') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="form-group">
                <label for="hojas">Hojas:</label>
                <input type="text" wire:model="hojas" class="form-control" id="hojas">{{{ $detail ?? '' }}}</textarea>
                @error('hojas') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
            <button class="btn btn-info nextBtn pull-right mt-2" wire:click="firstStepSubmit" type="button">Siguiente</button>
        </div>
    </div>
    <div class="row setup-content {{ $currentStep != 2 ? 'display-none' : '' }}" id="step-2">
        <div class="col-md-12">
            <h3> Documento: </h3>
            <div class="form-group">
                <label for="tarea">Tramite:</label>
                <select class="form-select js-basic-sel2" wire:model="tipo_tramite_id" aria-label="Default select example" id="tipo_tramite_id" name="tipo_tramite_id">
                    <option selected>Seleccione Opcion</option>
                    @foreach ($tipoTra as $tramite)
                        <option value="{{$tramite->id}}">{{$tramite->nombre}}</option>
                    @endforeach
                </select>
                @error('hojas') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="form-group">
                <label for="fecha_doc">Fecha:</label>
                <input type="date" class="form-control" id="fecha_doc" wire:model="fecha_doc" name="fecha_doc">
                @error('fecha_doc') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <label for="materia_id">Clasificacion Documento:</label>
                        <select class="form-select js-basic-sel2" wire:model="materia_id" aria-label="Default select example" id="materia_id" name="materia_id">
                            <option selected>Seleccione Opcion</option>
                            @foreach ($materias as $materia)
                                <option value="{{$materia->id}}">{{$materia->codigo}} - {{$materia->descripcion}}</option>
                            @endforeach
                        </select>
                        @error('materia_id') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>
            </div>
            <button class="btn btn-primary nextBtn pull-right mt-2" type="button" wire:click="secondStepSubmit">Siguiente</button>
            <button class="btn btn-danger nextBtn pull-right mt-2" type="button" wire:click="back(1)">Atras</button>
        </div>
    </div>
    <div class="row setup-content {{ $currentStep != 3 ? 'display-none' : '' }}" id="step-3">
        <div class="col-md-12">
            <h3> Origen / Destino</h3>
            <div class="form-group">
                <label for="fecha_doc">Del:</label>
                <input type="text" wire:model="origen" class="form-control" id="origen" value="{{Auth()->user()->Organizacion->sigla}}}}"></input>
                @error('origen') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="form-group">
                <label for="fecha_doc">Al:</label>
                <select id="organizacion_id" wire:model="organizacion_id" class="form-control js-example-basic-multiple" name="organizacion_id[]" :value="old('organizacion_id')" multiple>
                    @foreach ($organizaciones as $organizacion)
                        <option value="{{ $organizacion->id }}">{{$organizacion->sigla}} - {{$organizacion->nombre}}</option>
                    @endforeach
                    </select>
                @error('organizacion_id') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="form-group">
                <label for="fecha_doc">Al:</label>
                <select id="copiaInf" wire:model="copiaInf" class="form-control js-example-basic-multiple" name="copiaInf[]" :value="old('copiaInf')" multiple>
                    @foreach ($organizaciones as $organizacion)
                        <option value="{{ $organizacion->id }}">{{$organizacion->sigla}} - {{$organizacion->nombre}}</option>
                    @endforeach
                    </select>
                @error('copiaInf') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
            <button class="btn btn-info pull-right mt-2" wire:click="thirdStepSubmit" type="button">Siguiente</button>
            <button class="btn btn-danger nextBtn pull-right mt-2" type="button" wire:click="back(2)">Atras</button>
        </div>
    </div>
    <div class="row setup-content {{ $currentStep != 4 ? 'display-none' : '' }}" id="step-4">
        <div class="col-md-12">
            <h3> Cuerpo Documento</h3>
            <div class="form-group">
                <label for="fecha_doc">Cuerpo: </label>
                <textarea class="form-control summernote" name="summernote" id="summernote"></textarea>
            </div>
            <button class="btn btn-info pull-right mt-2" wire:click="fourStepSubmit" type="button">Siguiente</button>
            <button class="btn btn-danger nextBtn pull-right mt-2" type="button" wire:click="back(3)">Atras</button>
        </div>
    </div>
    <div class="row setup-content {{ $currentStep != 5 ? 'display-none' : '' }}" id="step-5">
        <div class="col-md-12">
            <h3> Step 3</h3>
            <table class="table">
                <tr>
                    <td>Clasificacion</td>
                    <td><strong>{{$clasificacion}}</strong></td>
                </tr>
                <tr>
                    <td>Materia/Numero Documento</td>
                    <td><strong>{{$materia_id}} / {{$num_doc}}</strong></td>
                </tr>
                <tr>
                    <td>Objeto</td>
                    <td><strong>{{$ejemplares}}</strong></td>
                </tr>
                <tr>
                    <td>Team status:</td>
                    <td><strong>{{$enviado ? 'Active' : 'DeActive'}}</strong></td>
                </tr>
                <tr>
                    <td>Team Detail:</td>
                    <td><strong>{{$hojas}}</strong></td>
                </tr>
            </table>
            <button class="btn btn-success pull-right" wire:click="submitForm" type="button">Finish!</button>
            <button class="btn btn-danger nextBtn pull-right" type="button" wire:click="back(4)">Atras</button>
        </div>
    </div>
            </div>
        </div>
    
    </div>
    
</div>

<script type="text/javascript">
    $('#summernote').summernote({
        height: 400
    });
</script>
