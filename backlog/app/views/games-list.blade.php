@extends('_master')

@section('title')
	List of Games
@stop

@section('content')

<h1>List of Games</h1>

@if($query)
	<h2>You searched for {{{ $query }}}</h2>
@endif

@if(sizeof($games) == 0)
	No results
@else
	@foreach($user->games as $game)
		<section class='game'>
			<h2>{{ $game['title'] }}</h2>
			<ul>
				<li>Title: {{ $game['title'] }}</li>
				<li>Franchise: {{ $game['franchise'] }}</li>
				<li>Genre: {{ $game['genre'] }}</li>

				<li>Status: {{ $game->users()->first()->pivot->status }}</li>
				<li>Progress: {{ $game->users()->first()->pivot->progress }}</li>
				<li>Currently Playing? {{ $game->users()->first()->pivot->currently_playing }}</li>
				<li>Rating: {{ $game->users()->first()->pivot->rating }}</li>
				<li>Additional Notes: {{ $game->users()->first()->pivot->notes }}</li>
				
			</ul>

			<p>
				<a href='/game/edit/{{$game['id']}}'>Edit</a>
			</p>
		</section>
	@endforeach
@endif

<br />
@stop