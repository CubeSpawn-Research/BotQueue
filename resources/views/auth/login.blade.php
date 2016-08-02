@extends('app')

@section('content')
    <div class="row-fluid">
        <div class="signin offset3 span6">
            <div class="title">Already a member? Sign in:</div>
            {!! Form::open('login') !!}

            {!! Form::text('username')
                ->label('Username')
            !!}

            {!! Form::password('password')
                ->label('Password')
            !!}

            {!! Form::checkbox('remember')
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

@section('end-js')
    <script src='https://www.google.com/recaptcha/api.js'></script>
@stop