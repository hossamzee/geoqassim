<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateStudentsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('students', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name')->unique();
			$table->enum('gender', ['male', 'female'])->default('male');
			$table->string('major')->nullable();
			$table->text('interests')->nullable();
			$table->string('photo_url')->nullable();
			$table->string('email')->nullable();
			$table->integer('position')->default(0);
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
		Schema::drop('students');
	}

}
