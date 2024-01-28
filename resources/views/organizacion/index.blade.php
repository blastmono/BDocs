@extends('layouts.tabler')
@section('css_extras')
<link rel="stylesheet" href="{{ asset('css/Treant.css') }}">
<link rel="stylesheet" href="{{ asset('css/base.css') }}">

<style>
  .node rect {
    width: 120px;
    height: 50px;
    fill: #f7f7f7;
    stroke: #333;
    stroke-width: 2px;
    cursor: grab;
  }

  .node text {
    font-size: 12px;
    fill: #333;
    pointer-events: none;
    text-align: center;
  }

  .link {
    fill: none;
    stroke: #ccc;
    stroke-width: 1.5px;
  }
</style>
@endsection
  
@section('content')
<!-- TABLA OCULTA
    <table class="table table-sm table-bordered table-hover table-condensed">
        <thead>
            <tr>
                <th>{{ __('Sigla') }}</th>
                <th>{{ __('Nombre') }}</th>
                <th>{{ __('Acciones') }}</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($organizaciones as $organizacion)
                <tr>
                    <td>{{ $organizacion->sigla }}</td>
                    <td>{{ $organizacion->nombre }}</td>
                    <td>
                    <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                    <a href="{{ route('organizacion.show', $organizacion) }}" class="btn btn-sm btn-info">Detalles</a>
                    <a href="{{ route('organizacion.edit', $organizacion) }}" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></a>
                    <form action="{{ route('organizacion.destroy', $organizacion) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                    </form>
                    </div>
                        
                        
                        
                    </td>
                </tr>
            @empty
                <tr class="bg-red-400 text-white text-center">
                    
                    <td colspan="3" class="border px-4 py-2"><div class="alert alert-warning">No hay Organizaciones para mostrar.</div></td>
                </tr>
            @endforelse
        </tbody>
    </table>
-->

<div id="tree-container" style="height: 100%; overflow-y: scroll;"></div>


@endsection
@section('script_extras')
<script src="https://d3js.org/d3.v5.min.js"></script>
<script>
  var data = <?php echo json_encode($structuredData); ?>;

  var treeData = d3.stratify()
    .id(function(d) { return d.id; })
    .parentId(function(d) { return d.parent; })
    (data);

  var treeLayout = d3.tree().size([3000, 350]);
  var nodes = treeLayout(treeData).descendants();

  var svg = d3.select("#tree-container").append("svg")
    .attr("width", 3000)
    .attr("height", 500)
    .append("g")
    .attr("transform", "translate(50,50)")
    .call(d3.zoom().on("zoom", function () {
      svg.attr("transform", d3.event.transform);
    }))
    .call(d3.drag()
      .on("start", dragstarted)
      .on("drag", dragged)
      .on("end", dragended));

  var link = svg.selectAll(".link")
    .data(treeLayout(treeData).links())
    .enter().append("path")
    .attr("class", "link")
    .attr("d", d3.linkVertical()
      .x(function(d) { return d.x; })
      .y(function(d) { return d.y; }));

  var node = svg.selectAll(".node")
    .data(nodes)
    .enter().append("g")
    .attr("class", "node")
    .attr("transform", function(d) { return "translate(" + d.x + "," + d.y + ")"; });

  node.append("rect")
    .attr("x", -80)
    .attr("y", -25)
    .attr("width", 160)
    .attr("height", 50)
    .attr("rx", 10)
    .attr("ry", 10)
    .attr("fill", "#f7f7f7")
    .attr("stroke", "#333")
    .attr("stroke-width", 2);

  node.append("text")
    .attr("dy", "0.3em")
    .attr("text-anchor", "middle")
    .attr("text-align","center")
    .text(function(d) { return d.data.sigla; })
    .attr("fill", "#333")
    .style("font-size", "12px");

  function dragstarted(event, d) {
    d3.select(this).raise().classed("active", true);
  }

  function dragged(event, d) {
    d3.select(this).attr("transform", "translate(" + (d.x = event.x) + "," + (d.y = event.y) + ")");
  }

  function dragended(event, d) {
    d3.select(this).classed("active", false);
  }
</script>  
  @endsection