<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateRummahsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('rummahs', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('slug')->nullable();
			$table->string('title');
			$table->mediumText('description')->nullable();
			$table->string('cover_url')->nullable();
			$table->string('url');
			$table->string('version');
			$table->integer('views_count')->default(0);
			$table->integer('likes_count')->default(0);
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
		Schema::drop('rummahs');
	}

}
