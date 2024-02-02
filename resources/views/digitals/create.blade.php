@extends('layouts.tabler')
@section('css_extras')
<link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}" />
<link rel="stylesheet" href="{{ asset('plugins/summernote/summernote-lite.css') }}" />
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">

<style>
    .display-none {
    display: none;
}
.multi-wizard-step p {
    margin-top: 12px;
}
.stepwizard-row {
    display: table-row;
}
.stepwizard {
    display: table;
    position: relative;
    width: 100%;
}
.multi-wizard-step button[disabled] {
    filter: alpha(opacity=100) !important;
    opacity: 1 !important;
}
.stepwizard-row:before {
    top: 14px;
    bottom: 0;
    content: " ";
    width: 100%;
    height: 1px;
    z-order: 0;
    position: absolute;
    background-color: #fefefe;
}
.multi-wizard-step {
    text-align: center;
    position: relative;
    display: table-cell;
}
</style>
@endsection
@section('ubicacion','Documento Digital')
@section('content')
    <livewire:asistente.asistente />
@endsection
@section('script_extras')
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="{{ asset('plugins/select2/js/select2.full.min.js')}}"></script>
<script src="{{ asset('plugins/summernote/summernote-lite.js')}}"></script>

<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
<script>
    jQuery(document).ready(function() {
        $('.js-basic-sel2').select2({
            placeholder: "Seleccione una opcion..."
        });
        $('.js-example-basic-multiple').select2({
            placeholder: "Seleccione una opcion...",
            maximumSelectionLength: 3
        });
    });
</script>
<script type="text/javascript">
    $('#summernote').summernote({
        height: 400
    });
</script>

@endsection