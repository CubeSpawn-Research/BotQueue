{!! Form::open('login') !!}

{!! Form::text('username')
    ->label('Username')
!!}

{!! Form::password('password')
    ->label('Password')
!!}

{!! Form::checkbox('remember_me')
    ->label("Remember me on this computer.")
    ->checked(true)
!!}

{!! Form::submit('Sign into your account')
    ->inputClass('btn btn-primary btn-large')
!!}

{!! Form::close() !!}