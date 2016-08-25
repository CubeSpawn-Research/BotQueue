@extends('app')

@section('title', 'Edit your queues')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <form class="form-horizontal" role="form" method="POST"
                      action="{{ action('Bot\EditController@postQueues', [$bot]) }}">
                    {{ csrf_field() }}
                    <div class="row">
                        <div id="left" class="dragula-container col-md-6" style="border-right: solid black 1px">
                            @foreach($queues as $queue)
                                <div class="control-group" style="margin-bottom: 10px">
                                    <h3 style="margin-top: 10px;"><span
                                                class="label label-default">{{ $queue->name }}</span></h3>
                                    <div class="controls">
                                        <input id="queue_{{ $queue->id }}" type="hidden" name="queues[]"
                                               value="{{ $queue->id }}">
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div id="right" class="dragula-container col-md-6" style="border-left: solid black 1px">
                            @foreach($ignored as $queue)
                                <div class="control-group" style="margin-bottom: 10px">
                                    <h3 style="margin-top: 10px;"><span
                                                class="label label-default">{{ $queue->name }}</span></h3>
                                    <div class="controls">
                                        <input id="queue_{{ $queue->id }}" type="hidden" name="ignored[]"
                                               value="{{ $queue->id }}">
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="form-group" style="margin-top: 3em;">
                        <div class="col-md-8 col-md-offset-4">
                            <button type="submit" class="btn btn-primary">
                                Update Queues
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop

@section('js')
    <script src='https://cdnjs.cloudflare.com/ajax/libs/dragula/3.7.1/dragula.js'></script>
    <script type='text/javascript'>
        $(document).ready(function () {
            dragula([document.getElementById("left"), document.getElementById("right")])
                    .on('drop', function (el, container) {
                        var input = $(el).find("input");
                        var label = $(el).find("label");

                        if (container.id === "left") {
                            input.attr('name', 'queues[]');
                            label.attr('for', 'queues[]');
                        }
                        if (container.id === "right") {
                            input.attr('name', 'ignored[]');
                            label.attr('for', 'ignored[]');
                        }
                    });
        });
    </script>
@stop

@section('css')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/dragula/3.7.1/dragula.css" rel="stylesheet">
    <style type="text/css">
        .dragula-container {
            padding: 1em;
            min-height: 8em;
        }
    </style>
@stop