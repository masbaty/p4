<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBacklogTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('games', function($table) {
			// Create ID and Timestamps
			$table->increments('id');
			$table->timestamps();

			$table->string('title');
			$table->string('franchise');
			$table->string('genre');
			$table->string('platform');
			$table->string('status');
			$table->string('progress');
			$table->string('currently_playing');
			$table->string('flags');
			$table->float('rating');
			$table->string('notes');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('games');
	}

}
