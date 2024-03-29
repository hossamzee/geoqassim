<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateResearchesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('researches', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('category_id');
			$table->string('slug')->nullable();
			$table->string('title');
			$table->string('author')->nullable();
			$table->integer('publish_year')->nullable();
			$table->string('url');
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
		Schema::drop('researches');
	}

}
