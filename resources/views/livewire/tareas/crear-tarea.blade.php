<form wire:submit="save" class="form-group">

    <input type="hidden" wire:model="docu" value={{$docu}}>

    <input type="hidden" wire:model="user_id" value="{{Auth::user()->id}}">

    <input type="hidden" wire:model="organizacion_id" value="{{Auth::user()->organizacion_id}}">

    <label for="tarea">Responsable</label>
    <select class="form-select js-basic-sel2" wire:model="responsable" aria-label="Default select example" id="tipo_tramite_id" name="tipo_tramite_id">
        <option selected>Seleccione Opcion</option>
        @foreach ($usuarios as $user)
            <option value="{{$user->id}}">{{$user->grado}}. {{$user->apellidoPaterno}} {{$user->apellidoMaterno}} {{$user->nombres}}</option>
        @endforeach
    </select>

    <label for="tarea">tarea</label>
    <input type="text" class="form-control" name="tarea" id="tarea" wire:model="tarea">

    <label for="tarea">Detalle</label>
    <input type="text" class="form-control" wire:model="detalle">

    <label for="tarea">Completada</label>
    <input type="checkbox" wire:model="completada">

    <label for="tarea">Plazo</label>
    <input type="date" class="form-control" wire:model="plazo">

    <button type="submit" class="btn btn-success mt-2">Guardar</button>
</form>