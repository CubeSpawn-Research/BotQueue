@extends('app')

@section('title', 'Edit your queues')

@section('content')
    {!! Form::open()
        ->formClass('dragula-wrapper')
     !!}

    <div id="left" class="dragula-container">

    </div>

    <div id="right" class="dragula-container">
        @foreach(Auth::user()->queues as $queue)
            {!! Form::input('hidden', 'ignored[]', $queue->name)
                ->label($queue->name)
             !!}
        @endforeach
    </div>


    {!! Form::submit('Update Queues') !!}

    {!! Form::close() !!}
@stop

@section('end-js')
    <script src='/js/dragula.min.js'></script>
    <script type='text/javascript'>
        $(document).ready(function () {
            dragula([document.getElementById("left"), document.getElementById("right")])
                    .on('drop', function(el, container) {
                        var input = $(el).find("input");
                        if(container.id === "left") {
                            input.attr('name', 'queues[]');
                        }
                        if(container.id === "right") {
                            input.attr('name', 'ignored[]');
                        }
                        console.log(input);
                        console.log(input.attr('name'));
                    });
        });
    </script>
@stop

@section('css')
    <link href="/css/dragula.css" rel="stylesheet">
@stop