<?php

class GameController extends \BaseController {

	public function __construct() {
		parent__construct();

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

}