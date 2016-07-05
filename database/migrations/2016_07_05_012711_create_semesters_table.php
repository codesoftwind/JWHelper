<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSemestersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('semesters', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('semesterID', 10);
			$table->integer('semesterYear');
			$table->integer('semesterWeek');
			$table->string('basicInfo', 1000);
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
		Schema::drop('semesters');
	}

}
