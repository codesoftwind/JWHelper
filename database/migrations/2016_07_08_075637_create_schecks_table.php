<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSchecksTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('schecks', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('studentID', 10);
			$table->string('studentName', 15);
			$table->integer('groupID');
			$table->string('headID', 10);
			$table->integer('status');
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('schecks');
	}

}
