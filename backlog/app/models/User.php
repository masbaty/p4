<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {

	public function games() {
		return $this->belongsToMany('Game');
	}

	use UserTrait, RemindableTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password', 'remember_token');

	public function sendWelcomeEmail() {
		$data = array('user' => Auth::user());

		Mail::send('emails.welcome', $data, function($message) {
			$recipient_email = $this->email;
			$recipient_name = $this->first_name.' '.$this->last_name;
			$subject = 'Welcome '.$this->first_name.'!';

			$message->to($recipient_email, $recipient_name)->subject($subject);
		});
	}

}
