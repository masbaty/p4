@extends('_master')

@section('title')
	Sign Up
@stop

@section('content')

<h1>Sign Up</h1>

@foreach($errors->all() as $message)
	<div class='error'>{{ $message }}</div>
@endforeach

{{ Form::open(array('url' => '/signup')) }}

	{{ Form::label('First Name') }}
	{{ Form::text('first_name') }}
<br />
	{{ Form::label('Last Name') }}
	{{ Form::text('last_name') }}
<br />
	{{ Form::label('Email Address') }}
	{{ Form::text('email') }}
<br />
	{{ Form::label('Password') }}
	{{ Form::text('password') }}
	<small>Minimum 6 characters</small>
<br />
	{{ Form::submit('Submit') }}

{{ Form::close() }}

@stop