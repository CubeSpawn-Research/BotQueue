@extends('app')

@section('content')
    <div class="row">
        <h1 class="col-md-3">{{ $queue->name }}</h1>

        @can('modify', $queue)
            <div class="pull-right">
                @can('edit', $queue)
                    <a href="{{ action('QueueController@getEdit', [$queue]) }}" class="btn btn-lg btn-primary">Edit
                        Queue</a>
                @endcan
                @can('delete', $queue)
                    <a href="{{ action('QueueController@getDelete', [$queue]) }}" class="btn btn-lg btn-danger">Delete
                        Queue</a>
                @endcan
            </div>
        @endcan
    </div>

    <div class="row">
        <div class="col-md-4">
            <h3>Delay:
                @if($queue->delay == 0)
                    None
                @else
                    {{ $queue->delay }} seconds
                @endif
            </h3>

            <h3>Bots</h3>
            Bots listing

            <h3>Statistics</h3>
            Some stats
        </div>
    </div>
@stop