@extends('app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="jumbotron">
                    <h1 class="alert-heading">Warning!</h1>
                    <p>Are you sure you want to delete this bot? This is permanent and will remove all information
                        about
                        this bot, including all jobs it has run.</p>
                    <form action="{{ action('Bot\EditController@postDelete', [$bot]) }}" method="post">
                        {{ csrf_field() }}
                        <button type="submit" class="btn btn-danger">Delete Bot</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop
