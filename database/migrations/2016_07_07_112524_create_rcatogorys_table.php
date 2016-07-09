<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRcatogorysTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('rcatogorys', function(Blueprint $table)
		{
			$table->increments('catogoryID');
			$table->string('catogoryName', 20);
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
		Schema::drop('rcatogorys');
	}

}
