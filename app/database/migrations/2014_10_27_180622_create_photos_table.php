<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePhotosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('photos', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('album_id');
			$table->string('slug')->nullable();
			$table->string('thumb_url');
			$table->string('large_url');
			$table->string('title');
			$table->mediumText('description')->nullable();
			$table->integer('views_count')->default(0);
			$table->integer('likes_count')->default(0);
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
		Schema::drop('photos');
	}

}
