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
		{{ Form::label('status','Status') }}
		{{ Form::text('status',$game->users()->first()->pivot->status); }}
	</div>
	<div>
		{{ Form::label('progress','Progress') }}
		{{ Form::text('progress',$game->users()->first()->pivot->progress); }}
	</div>
	<div>
		{{ Form::label('currently_playing','Currently playing?') }}
		{{ Form::text('currently_playing',$game->users()->first()->pivot->currently_playing); }}
	</div>
	<div>
		{{ Form::label('rating','Rating') }}
		{{ Form::text('rating',$game->users()->first()->pivot->rating); }}
	</div>
	<div>
		{{ Form::label('notes','Notes') }}<br />
		{{ Form::textarea('notes',$game->users()->first()->pivot->notes,['size' => '50x5']); }}
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