<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', function()
{
	return View::make('index');
});

Route::get('/classes', function() 
{
    echo Paste\Pre::render(get_declared_classes(),'');
});


// User (Explicit)
Route::get('/signup', 'UserController@getSignup');
Route::get('/login', 'UserController@getLogin');
Route::post('/signup', 'UserController@postSignup');
Route::post('/login', 'UserController@postLogin');
Route::get('/logout', 'UserController@getLogout');

// Game (Explicit)




Route::get('/practice-creating', function() {
    $game = new Game();

    $game->title = 'The Legend of Zelda: Wind Waker';
    $game->franchise = 'The Legend of Zelda';
    $game->genre = 'Action Adventure';
    $game->platform = 'Nintendo GameCube';
    $game->status = 'In Progress';
    $game->progress = "Just acquired Earth God's Lyric";
    $game->currently_playing = 'Y';
    $game->rating = '5';
    $game->notes = 'I also own the HD version on the Wii U';

    $game->save();

    return 'Your entry has been saved.';
});

Route::get('/practice-reading', function() {
    $games = Game::all();

    if($games->isEmpty() != TRUE) {
        foreach($games as $game) {
            echo $game->title.'<br />';
        }
    }
    else {
        return 'Nothing found.';
    }
});

Route::get('/practice-reading-one', function() {
    $game = Game::where('currently_playing', 'LIKE', '%Y%')->first();

    if($game) {
        return $game->title;
    }   
    else {
        return 'Nothing found.';
    }
});


// Debugging Routes ///////////////////////////

Route::get('/get-environment',function() {

    echo "Environment: ".App::environment();

});

Route::get('/trigger-error',function() {

    # Class Foobar should not exist, so this should create an error
    $foo = new Foobar;

});

Route::get('mysql-test', function() {

    # Print environment
    echo 'Environment: '.App::environment().'<br>';

    # Use the DB component to select all the databases
    $results = DB::select('SHOW DATABASES;');

    # If the "Pre" package is not installed, you should output using print_r instead
    echo Pre::render($results);

});

Route::controller('debug', 'DebugController');