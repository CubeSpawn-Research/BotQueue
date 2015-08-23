@extends('app')

@section('title', 'Register a New Queue')

@section('content')
{!! Form::open() !!}

{!! Form::text('name')
->label('Name')
->help('What is the name of this queue?')
!!}

{!! Form::number('delay')
->label('Delay')
->help('What is the delay between starting prints in seconds?')
!!}

{!! Form::submit('Create Queue') !!}

{!! Form::close() !!}
@stop