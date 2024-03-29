<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDocumentsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('documents', function(Blueprint $table)
		{
			$table->engine = 'MyISAM';
			$table->increments('id');
			$table->string('uri')->unique();
			$table->string('title');
			$table->text('content')->nullable();
			$table->integer('position')->default(0);
			$table->timestamps();
		});

		// Create FULLTEXT index.
		DB::statement('ALTER TABLE documents ADD FULLTEXT search(title, content)');

	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('documents');
	}

}
