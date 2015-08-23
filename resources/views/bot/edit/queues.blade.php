@extends('app')

@section('title', 'Edit your queues')

@section('content')
    <div class="dragula-wrapper">
        <div id="left" class="dragula-container">
            <div>This is a thing</div>
            <div>This is yet another thing</div>
        </div>

        <div id="right" class="dragula-container">
            <div>This is another thing</div>
        </div>
    </div>
@stop

@section('end-js')
    <script src='/js/dragula.min.js'></script>
    <script type='text/javascript'>
        dragula([document.getElementById("left"), document.getElementById("right")]);
    </script>
@stop

@section('css')
    <link href="/css/dragula.css" rel="stylesheet">
@stop