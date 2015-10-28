@extends('app')

@section('title', 'Create New Job - This should also be a file link')

@section('content')
    {!! Form::open() !!}

    {!! Form::display('file')
        ->label('File')
        ->value('This should link to the file')
        ->help('The file that will be printed')
        !!}

    {!! Form::text('name')
        ->label('Name')
        ->defaultValue($file->name)
        ->help('The name of the job')
        !!}

    {!! Form::select('queue')
        ->options($queues, 'name')
        ->label('Queue')
        ->help('Which queue are you adding this job to?')
        !!}

    {!! Form::text('quantity')
        ->defaultValue(1)
        ->label('Quantity')
        ->help('How many copies?')
        !!}

    {!! Form::submit() !!}

    {!! Form::close() !!}
@stop