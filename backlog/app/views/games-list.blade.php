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
	@foreach($games as $game)
		<section class='game'>
			<h2>{{ $game['title'] }}</h2>
			<ul>
				<li>Title: {{ $game['title'] }}</li>
				<li>Franchise: {{ $game['franchise'] }}</li>
				<li>Genre: {{ $game['genre'] }}</li>

				<li>Status: {{ Game::getPivotData('status'); }}</li>
				<li>Progress: {{ Game::getPivotData('progress'); }}</li>
				<li>Currently Playing? {{ Game::getPivotData('currently_playing'); }}</li>
				<li>Rating: {{ Game::getPivotData('rating'); }}</li>
				<li>Additional Notes: {{ Game::getPivotData('notes'); }}</li>
				<li>Additional Notes: {{ $game->pivot['notes'] }}</li>
				
			</ul>

			<p>
				<a href='/game/edit/{{$game['id']}}'>Edit</a>
			</p>
		</section>
	@endforeach
@endif

<br />
@stop