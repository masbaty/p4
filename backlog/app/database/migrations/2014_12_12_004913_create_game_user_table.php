<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGameUserTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('game_user', function($table) {
			$table->increments('relationship_id');
			$table->timestamps();

			// Create foreign keys
			$table->integer('game_id')->unsigned();
			$table->integer('user_id')->unsigned();

			// Other fields
			$table->string('status');
			$table->string('progress');
			$table->string('currently_playing');
			$table->float('rating');
			$table->text('notes');

			// Define foreign keys
			$table->foreign('game_id')->references('id')->on('games')->onDelete('cascade');
			$table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('game_user');
	}

}
