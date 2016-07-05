<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePubhomeworkTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('pubhomework', function(Blueprint $table)
		{
			$table->increments('homeworkID');
			$table->string('teacherID', 10);
			$table->string('lessonID', 10);
			$table->string('semesterID', 10);
			$table->string('description', 1000);
			$table->timestamp('startTime');
			$table->timestamp('endTime');
			$table->boolean('team');
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
		Schema::drop('pubhomework');
	}

}
