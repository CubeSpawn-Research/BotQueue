@extends('app')

@section('title', 'Login')

@section('content')
    <div id="signin" class="span6 center">
        <div class="title">Sign in:</div>

	    {!! Form::open() !!}

	    {!! Form::text('username')
	        ->label('Username')
	    !!}

	    {!! Form::password('password')
	        ->label('Password')
	    !!}

	    {!! Form::checkbox('remember_me')
	        ->label("Remember me on this computer.")
	        ->checked(true)
	    !!}

	    {!! Form::close() !!}
    </div>
@stop