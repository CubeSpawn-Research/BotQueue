@extends('app')

@section('title', 'Edit your queues')

@section('content')
    {!! Form::open()
        ->formClass('dragula-wrapper')
     !!}

    <div id="left" class="dragula-container">
        @foreach($queues as $queue)
            {!! Form::input('hidden', 'queues[]', $queue->id)
                ->label($queue->name)
             !!}
        @endforeach
    </div>

    <div id="right" class="dragula-container">
        @foreach($ignored as $queue)
            {!! Form::input('hidden', 'ignored[]', $queue->id)
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
                        var label = $(el).find("label");
                        if(container.id === "left") {
                            input.attr('name', 'queues[]');
                            label.attr('for', 'queues[]');
                        }
                        if(container.id === "right") {
                            input.attr('name', 'ignored[]');
                            label.attr('for', 'ignored[]');
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