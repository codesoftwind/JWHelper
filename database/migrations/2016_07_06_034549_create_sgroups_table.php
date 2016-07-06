<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSgroupsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('sgroups', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('groupID');
			$table->string('studentID', 10);
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
		Schema::drop('sgroups');
	}

}
