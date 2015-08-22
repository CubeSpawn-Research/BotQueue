@extends('app')

@section('content')
    <div class="row-fluid">
        <div class="signin span6">
            <div class="title">Already a member? Sign in:</div>
            @include('auth.login')
        </div>
        <div class="signin span6">
            <div class="title">Not a member? Create a free account:</div>
            @include('auth.register')
        </div>
    </div>
@stop

@section('end-js')
    <script src='https://www.google.com/recaptcha/api.js'></script>
@stop