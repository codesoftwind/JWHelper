<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShomeworksTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('shomeworks', function(Blueprint $table)
		{
			$table->increments('shomeworkID');
			$table->integer('thomeworkID');
			$table->boolean('group');
			$table->integer('groupID');
			$table->string('studentID', 10);
			$table->string('lessonID', 10);
			$table->string('semesterID', 10);
			$table->integer('grade');
			$table->string('comment', 1000);
			$table->string('content', 1000);
			$table->string('attachment', 100);
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
		Schema::drop('shomeworks');
	}

}
