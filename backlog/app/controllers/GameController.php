<?php

class GameController extends \BaseController {

	public function __construct() {
		parent::__construct();

		$this->beforeFilter('auth');
	}

	/*
	*@return View
	*/
	public function getIndex() {
		$format = Input::get('format', 'html');
		$query = Input::get('query');
		$games = Game::all();

		if($format == 'html') {
			return View::make('games-list')
				->with('games', $games)
				->with('query', $query);
		}
	}

	public function getDigest() {
		$games = Game::getGamesAddedInTheLast24Hours();

		$users = User::all();

		$recipients = Game::sendDigests($users, $games);

		$results = 'Game digest sent to: '.$recipients;

		Log::info($results);

		return $results;
	}

	/**
	*@return View
	*/
	public function getSearch() {
		return View::make('search');
	}

	/**
	*@return View
	*/
	public function getCreate() {
		return View::make('add');
	}

	/**
	*@return Redirect
	*/
	public function postCreate() {
		$game = new Game();
		$user = Auth::user()->get();

		$game->fill(Input::except('status','progress','currently_playing','rating','notes'));
		$game->save();

		$game->users()->attach($user);
		$user->fill(Input::except('title','franchise','genre','platform'));

		return Redirect::action('GameController@getIndex')->with('flash_message','Your game has been added.');
	}

}