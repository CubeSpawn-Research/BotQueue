@extends('app')

@section('title', 'Edit Queue: '. e($queue->name))

@section('content')
    {!! Form::model($queue) !!}

    {!! Form::text('name')
    ->label('Name')
    ->help('What is the name of this queue?')
    !!}

    {!! Form::number('delay')
    ->label('Delay')
    ->help('What is the delay between starting prints in seconds?')
    !!}

    {!! Form::submit('Update Queue') !!}

    {!! Form::close() !!}
@stop