@extends('app')

@section('title', 'Register a new Bot')

@section('content')
	{!! Form::open() !!}

	{!! Form::text('name')
		->label('Bot Name')
		->help('What should humans call your bot?')
	!!}

	{!! Form::text('manufacturer')
		->label('Manufacturer')
		->help('Which company (or person) built your bot?')
	!!}

	{!! Form::text('model')
		->label('Model')
		->help('What is the model or name of your bot design?')
	!!}

	{!! Form::submit('Create your bot') !!}

	{!! Form::close() !!}
@stop