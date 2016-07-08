<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTsgroupsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tsgroups', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('teacherID', 10);
			$table->string('lessonID', 10);
			$table->integer('groupID');
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
		Schema::drop('tsgroups');
	}

}
