@extends('app')

@section('content')
    <div class="row">
        <h1 class="col-md-3">Queue List</h1>
        <div class="col-md-2 col-md-offset-7">
            <a href="{{ url('/queue/create') }}" class="btn btn-lg btn-primary">Create New Queue</a>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <table class="table">
                <thead>
                <th>Queue Name</th>
                <th>Delay</th>
                </thead>
                <tbody>
                @foreach($queues as $queue)
                    <tr>
                        <td><a href="{{ url('queue', [$queue]) }}">{{ $queue->name }}</a></td>

                        @if($queue->delay == 0)
                            <td>None</td>
                        @else
                            <td>{{ $queue->delay }} seconds</td>
                        @endif
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@stop