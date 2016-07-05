<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHomeworksTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('homeworks', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('homeworkID', 10);
			$table->string('homeworkName', 15);
			$table->boolean('team');
			$table->string('teamID', 10);
			$table->string('studentID', 10);
			$table->string('lessonID', 10);
			$table->string('semesterID', 10);
			$table->integer('grade');
			$table->string('comment', 255);
			$table->string('homeworkContent', 1000);
			$table->string('homeworkAttachment', 30);
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
		Schema::drop('homeworks');
	}

}
