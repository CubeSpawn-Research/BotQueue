<?php

use App\Facades\Migrate;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		// Convert the table from an old installation.
		if(Schema::hasTable('users')) {
			$this->convertTable();
		} else {
			$this->createTable();
		}

		Schema::table('users', function(Blueprint $table) {
			$table->index('email');
			$table->index('updated_at');
			$table->index('password');
			$table->index('username');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('users');
	}

	private function createTable()
	{
		Schema::create('users', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('username', 32);
			$table->string('email');
			$table->string('password', 60);
			$table->integer('last_notification');
			$table->string('dashboard_style')->default('large_thumbnails');
			$table->string('thingiverse_token', 40);
			$table->boolean('is_admin');
			$table->dateTime('created_at');
			$table->dateTime('updated_at');
		});
	}

	private function convertTable()
	{
		Migrate::convertEnum('users', 'dashboard_style', 'large_thumbnails');

		Schema::table('users', function(Blueprint $table) {
			$table->dropIndex('last_active');
			$table->dropIndex('pass_hash');
			$table->dropIndex('email');
			$table->dropIndex('username');

			$table->renameColumn('pass_hash', 'password');
			$table->renameColumn('last_active', 'updated_at');
			$table->renameColumn('registered_on', 'created_at');

			$table->dropColumn('pass_reset_hash');
			$table->dropColumn('location');
			$table->dropColumn('birthday');

			$table->boolean('is_admin')->change();
		});

		// Separate because we need pass_hash to become password first
		Schema::table('users', function(Blueprint $table) {
			$table->string('password', 60)->change();
		});
	}

}
