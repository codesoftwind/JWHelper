<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTschecksTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tschecks', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('groupID');
			$table->string('groupName', 15);
			$table->string('teacherID', 10);
			$table->string('lessonID', 10);
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
		Schema::drop('tschecks');
	}

}
