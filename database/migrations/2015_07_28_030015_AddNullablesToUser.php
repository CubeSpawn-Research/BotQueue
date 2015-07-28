<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddNullablesToUser extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('users', function(Blueprint $table)
		{
			$table->integer('last_notification')->default(0)->change();
			$table->string('thingiverse_token', 40)->nullable()->change();
			$table->boolean('is_admin')->default(false)->change();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('users', function(Blueprint $table)
		{
			$table->integer('last_notification')->change();
			$table->string('thingiverse_token', 40)->change();
			$table->boolean('is_admin')->change();
		});
	}

}
