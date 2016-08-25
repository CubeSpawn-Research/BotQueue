@extends('app')

@section('title', 'Delete Queue')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="jumbotron">
                    <h1 class="alert-heading">Warning!</h1>
                    <p>Are you sure you want to delete this queue? This is permanent and will remove all information
                        about
                        this queue, including all jobs contained within.</p>
                    <form action="{{ action('QueueController@postDelete', [$queue]) }}" method="post">
                        {{ csrf_field() }}
                        <button type="submit" class="btn btn-danger">Delete Queue</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop
