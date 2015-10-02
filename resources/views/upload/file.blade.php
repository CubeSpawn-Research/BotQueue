{!! Form::open('upload')
    ->formClass('form-inline')
    !!}

    {!! Form::upload('file') !!}

    {!! Form::submit('Upload File') !!}

{!! Form::close() !!}