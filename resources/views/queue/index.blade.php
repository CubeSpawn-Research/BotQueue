@extends('app')

@section('title', Auth::user()->username . "'s Queues");

@section('content')
    @foreach($queues as $queue)
        <a href="{{ route('queue', [$queue]) }}">{{ $queue->name }}</a><br>
    @endforeach

    {!! $queues->render() !!}
@stop