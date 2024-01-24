<div>
    <button wire:click="$refresh">Refresh</button>
    <table class="table table-sm condensed">
        <thead>
            <th>Plazo</th>
            <th>Responsable</th>
            <th>Tarea</th>
            <th>Detalle</th>
            <th>Completada</th>
        </thead>
        <tbody>
            @foreach($tareas as $tarea)
                <tr>
                    <td>{{$tarea->plazo}}</td>
                    <td>{{$tarea->user->grado}}. {{$tarea->user->apellidoPaterno}} {{$tarea->user->apellidoMaterno}}</td>
                    <td>{{$tarea->tarea}}</td>
                    <td>{{$tarea->detalle}}</td>
                    <td class="text-center">@if($tarea->completada == 1) 
                        <input type="checkbox" checked disabled>
                        @else
                        <input type="checkbox" disabled>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
