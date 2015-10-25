@extends('app')

@section('title', 'Create New Job - This should also be a file link')

@section('content')
    {!! Form::open() !!}

    {!! Form::display('file')
        ->label('File')
        ->value('This should link to the file')
        ->help('The file that will be printed.')
        !!}

    {!! Form::select('queue')
        ->options($queues, 'name')
        ->label('Queue')
        ->help('Which queue are you adding this job to?')
        !!}

    {!! Form::text('quantity')
        ->label('Quantity')
        ->help('How many copies?')
        !!}

    {!! Form::checkbox('priority')
        ->label('Is this a priority job?')
        ->help('Check this box to push this job to the top of the queue')
        ->checked(false)!!}

    {!! Form::submit() !!}

    {!! Form::close() !!}
@stop