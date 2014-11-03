<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMembersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('members', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name')->unique();
			$table->enum('role', ['member', 'head'])->default('member');
			$table->mediumText('bio');
			$table->text('cv');
      $table->string('photo_url');
      $table->string('email')->nullable();
			$table->string('twitter_account')->nullable();
			$table->string('linkedin_account')->nullable();
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
		Schema::drop('members');
	}

}
