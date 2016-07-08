<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateThomeworksTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('thomeworks', function(Blueprint $table)
		{
			$table->increments('thomeworkID');
			$table->string('thomeworkName', 30);
			$table->boolean('group');
			$table->string('teacherID', 10);
			$table->string('lessonID', 10);
			$table->string('semesterID', 10);
			$table->string('description', 1000);
			$table->timestamp('startTime');
			$table->timestamp('endTime');
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
		Schema::drop('thomeworks');
	}

}
