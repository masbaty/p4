<?php

class Game extends Eloquent {
	
    public function users() {
        return $this->belongsToMany('User')->withPivot('status','progress','currently_playing','rating','notes');
    }

    public function relationship() {
        
    }


    public static function pivotData($query) {
        $user = User::find(1);

        foreach ($user->games as $game)
        {
            return $game->pivot->$query;
        }
    }

	protected $guarded = array('id', 'created_at', 'updated_at');

	/**
    * @return Collection
    */
    public static function search($query) {
    	//
    }

    /**
    *@return Collection
    */
    public static function getGamesAddedInTheLast24Hours() {
    	$past_24_hours = strtotime('-1 day');

    	$past_24_hours = date('Y-m-d H:i:s', $past_24_hours);

    	$games = Game::where('created_at', '>', $past_24_hours)->get();

    	return $games;
    }

    /**
    *@return String
    */
    public static function sendDigests($users, $games) {
    	$recipients = '';

    	$data['games'] = $games;

    	foreach($users as $user) {
    		$data['user'] = $user;

    		Mail::send('emails.digest', $data, function($message) {
    			$recipient_email = $user->email;
    			$recipient_name = $user->first_name.' '.$user->last_name;
    			$subject = 'Games Digest';

    			$message->to($recipient_email, $recipient_name)->subject($subject);
    		});

    		$recipients .= $user->email.', ';
    	}

    	$recipients = rtrim($recipients, ',');

    	return $recipients;
    }



}