@extends('_master')

@section('title')
	Add Game
@stop

@section('content')

<h1>Add Game</h1>


{{ Form::open(array('url' => '/game/create')) }}

	{{ Form::label('Title') }}
	{{ Form::text('title') }}
<br />
	{{ Form::label('Franchise') }}
	{{ Form::text('franchise') }}
<br />
	{{ Form::label('Genre') }}
	{{ Form::text('genre') }}
<br />
	{{ Form::label('Platform') }}
	{{ Form::text('platform') }}
<br />
	{{ Form::label('Status') }}
	{{ Form::text('status') }}
<br />
	{{ Form::label('Progress') }}
	{{ Form::text('progress') }}
<br />
	{{ Form::label('Currently Playing?') }}
	{{ Form::text('currently_playing') }}
<br />
	{{ Form::label('Rating') }}
	{{ Form::text('rating') }}
<br />
	{{ Form::label('Notes') }}
	{{ Form::text('notes') }}
<br />
	{{ Form::submit('Submit') }}

{{ Form::close() }}

@stop