<?php

class UserController extends BaseController {

	public function __construct() {
		parent::__construct();

		$this->beforeFilter('guest',
			array(
					'only' => array('getLogin', 'getSignup')
				));
	}

	/**
	*@return View
	*/
	public function getSignup() {
		return View::make('signup');
	}

	/**
	*@return Redirect
	*/
	public function postSignup() {

		// Rules
		$rules = array(
				'email' => 'required|email|unique:users,email',
				'password' => 'required|min:6'
			);

		// Validate
		$validator = Validator::make(Input::all(), $rules);

		// Feedback
		if ($validator->fails()) {
			return Redirect::to('/signup')
				->with('flash_message', 'Sign up failed; please try again.')
				->withInput()
				->withErrors($validator);
		}

		$user = new User;
		$user->email = Input::get('email');
		$user->password = Hash::make(Input::get('password'));

		try {
			$user->save();
		}
		catch (Exception $e) {
			return Redirect::to('/signup')
				->with('flash_message', 'Sign up failed, please try again.')
				->withInput();
		}

		Auth::login($user);

		
		$user->sendWelcomeEmail();
		

		return Redirect::to('/')->with('flash_message', 'Welcome to your collection!');

	}

	/**
	*@return View
	*/
	public function getLogin() {
		return View::make('login');
	}

	/**
	*@return View
	*/
	public function postLogin() {
		$credentials = Input::only('email', 'password');

		if (Auth::attempt($credentials, $remember = false)) {
			return Redirect::intended('/')->with('flash_message', 'Welcome Back!');
		}
		else {
			return Redirect::to('/login')
				->with('flash_message', 'Log in failed, please try again.')
				->withInput();
		}
	}

	/**
	*@return Redirect
	*/
	public function getLogout() {
		Auth::logout();

		return Redirect::to('/');
	}

}