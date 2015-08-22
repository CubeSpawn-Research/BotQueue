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