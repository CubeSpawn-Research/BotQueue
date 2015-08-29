@extends('app')

@section('title', Auth::user()->username . "'s Queues");

@section('content')
    @foreach($queues as $queue)
        {{ $queue->name }}<br>
    @endforeach

    {!! $queues->render() !!}
@stop