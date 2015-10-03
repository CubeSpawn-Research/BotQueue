{!! Form::open('upload/file')
    ->formClass('form-inline')
    !!}

    {!! Form::upload('file') !!}

    {!! Form::submit('Upload File') !!}

{!! Form::close() !!}