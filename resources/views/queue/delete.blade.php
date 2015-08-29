@extends('app')

@section('title', 'Delete Queue')

@section('content')
    {!! Form::open() !!}

    <div class="alert alert-block">
        <h4 class="alert-heading">Warning!</h4>
        Are you sure you want to delete this queue?  This is permanent and will remove all information about this queue, including all jobs contained within.<br/><br/>
        <button type="submit" class="btn btn-primary">Delete Queue</button>
    </div>

    {!! Form::close() !!}
@stop
