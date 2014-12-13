@extends("_master")

@section("title")
	Project 4 - Final Project
@stop

@section("head")
@stop

@section("content")

	<h1>Final Project</h1>

	{{ Form::open(array('url' => '/game', 'method' => 'GET' )) }}

		{{ Form::label('query', 'Search') }}

		{{ Form::text('query'); }}

		{{ Form::submit('Search'); }}

	{{ Form::close() }}

@stop

