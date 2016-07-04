<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTlessonsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tlessons', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('teacherID', 10);
			$table->string('lessonID', 10);
			$table->string('semesterID', 10);
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
		Schema::drop('tlessons');
	}

}
