@extends('app')

@section('content')

    <div class="row">
        <h1 class="col-md-6">{{ $bot->name }}</h1>

        <div class="pull-right">
            <a href="{{ action('Bot\EditController@getQueues', [$bot]) }}" class="btn btn-lg btn-primary">Edit
                Queues</a>
            <a href="{{ action('Bot\EditController@getDelete', [$bot]) }}" class="btn btn-lg btn-danger">Delete Bot</a>
        </div>
    </div>

    <h3>Queues</h3>
    @foreach($bot->queues as $queue)
        <span class="label label-default">{{$queue->name}}</span>
    @endforeach
@endsection