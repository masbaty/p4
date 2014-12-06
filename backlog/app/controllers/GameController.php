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
		$games = Game::search($query);

		if($format == 'html') {
			return View::make('game_index')
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

}