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
		$user = Auth::user();

		if($format == 'html') {
			return View::make('games-list')
				->with('games', $games)
				->with('query', $query)
				->with('user', $user);
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
		$user = Auth::user();

		$game->fill(Input::except('status','progress','currently_playing','rating','notes','_token'));
		$game->save();

		/*$game->users()->attach($user, array(
			'status' => Input::get('status'),
			'progress' => Input::get('progress'),
			'currently_playing' => Input::get('currently_playing'),
			'rating' => Input::get('rating'),
			'notes' => Input::get('notes')
			));*/
		$game->users()->sync([$user->id => ['status' => Input::get('status'),
			'progress' => Input::get('progress'),
			'currently_playing' => Input::get('currently_playing'),
			'rating' => Input::get('rating'),
			'notes' => Input::get('notes')
			] ], false);

		return Redirect::action('GameController@getIndex')->with('flash_message','Your game has been added.');
	}

	/**
	*@return View
	*/
	public function getEdit($id) {
		try {
			$game = Game::findOrFail($id);
		}
		catch(exception $e) {
			return Redirect::to('/game')->with('flash_message', 'Game not found');
		}

		return View::make('edit')
			->with('game', $game);
	}

	/**
	*@return Redirect
	*/
	public function postEdit() {
		try {
			$game = Game::findOrFail(Input::get('id'));
		}
		catch(exception $e) {
			return Redirect::to('/game')->with('flash_message', 'Game not found');
		}

		try {
			$game->fill(Input::except('notes'));
			$game->save();
			// Update existing pivot here
			$user = Auth::user();
			$game_user = $game->users->find($user->id);
			$game->users->find($user->id)->pivot->notes = Input::get('notes');
			$game_user->pivot->save();

			return Redirect::action('GameController@getIndex')
				->with('flash_message', 'Your changes have been saved.');
		}
		catch(exception $e) {
			Debugbar::addException($e);
			return Redirect::to('/game')->with('flash_message', 'Error saving changes. Your error message is: '.$e);
		}

	}

	/**
	*@return Redirect
	*/
	public function postDelete() {
		try {
			$game = Game::findOrFail(Input::get('id'));
		}
		catch(exception $e) {
			return Redirect::to('/game/')->with('flash_message', 'Could not delete game - not found.');
		}

		$game->users()->detach(Input::get('id'));
		Game::destroy(Input::get('id'));

		return Redirect::to('/game/')->with('flash_message', 'Game deleted.');
	}

}