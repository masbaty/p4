@extends('_master')

@section('title')
	Edit Game
@stop

@section('content')

<h1>Edit {{{ $game['title'] }}}</h1>

{{ Form::open(array('url' => '/game/edit')) }}
	{{ Form::hidden('id',$game['id']); }}

	<div>
		{{ Form::label('title','Title') }}
		{{ Form::text('title',$game['title']); }}
	</div>
	<div>
		{{ Form::label('franchise','Franchise') }}
		{{ Form::text('franchise',$game['franchise']); }}
	</div>
	<div>
		{{ Form::label('genre','Genre') }}
		{{ Form::text('genre',$game['genre']); }}
	</div>
	<div>
		{{ Form::label('notes','Notes') }}
		{{ Form::text('notes',$game->users()->first()->pivot->notes); }}
	</div>
	

	{{ Form::submit('Save'); }}
{{ Form::close() }}

<div>
	{{ Form::open(array('url' => '/game/delete')) }}
		{{ Form::hidden('id',$game['id']); }}
		<button onClick='parentNode.submit();return false;'>Delete</button>
	{{ Form::close() }}
</div>



@stop