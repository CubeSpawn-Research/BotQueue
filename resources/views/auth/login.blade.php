@extends('app')

@section('content')
<div id="page_signin">
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

	    {!! Form::submit('Sign into your account')
	        ->inputClass('btn btn-primary btn-large')
	    !!}

	    {!! Form::close() !!}
    </div>
</div>
@stop