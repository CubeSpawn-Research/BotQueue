<?php

{{ Form::open(); }}

@foreach($fields AS $name => $field):
	$field->render();
@endforeach

{{ Form::close(); }}