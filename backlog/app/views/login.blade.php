@extends('_master')

@section('title')
	Log In
@stop

@section('content')

	<h1>Log In</h1>

	{{ Form::open(array('url' => '/login')) }}

		{{ Form::label('email') }}
		{{ Form::text('email','masbaty@yahoo.com') }}
<br />
		{{ Form::label('password') }}
		{{ Form::password('password') }}
<br />
		{{ Form::submit('Submit') }}

	{{ Form::close() }}

@stop