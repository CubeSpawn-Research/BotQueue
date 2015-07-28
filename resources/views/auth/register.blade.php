@extends('app')

@section('content')
<div id="page_signin">
	<div id="signin" class="span6 center">
		<div class="title">Register:</div>

		{!! Form::open() !!}

		{!! Form::text('username')
			->label('Username')
		!!}

		{!! Form::text('email')
			->label('Email address')
		!!}

		{!! Form::password('password')
			->label('Password')
		!!}

		{!! Form::password('password_confirmation')
			->label('Password Confirmation')
		!!}

		{!! Form::submit('Create your account')
			->inputClass('btn btn-success btn-large')
		!!}

		{!! Form::close() !!}
	</div>
</div>
@stop