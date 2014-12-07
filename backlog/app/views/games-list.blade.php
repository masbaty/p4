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

			<p>
				<a href='/game/edit/{{$game['id']}}'>Edit</a>
			</p>
		</section>
	@endforeach
@endif

<br />
@stop