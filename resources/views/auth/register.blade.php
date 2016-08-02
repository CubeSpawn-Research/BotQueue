@extends('app')

@section('content')
    <div class="row-fluid">
        <div class="signin span6">
            <div class="title">Not a member? Create a free account:</div>
            {!! Form::open('register') !!}

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

@section('end-js')
    <script src='https://www.google.com/recaptcha/api.js'></script>
@stop