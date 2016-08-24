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
		Schema::create('users', function(Blueprint $table) {
            $table->increments('id');
            $table->string('username', 32);
            $table->string('email');
            $table->string('password', 60);
            $table->integer('last_notification');
            $table->string('dashboard_style')->default('large_thumbnails');
            $table->string('thingiverse_token', 40);
            $table->boolean('is_admin');
            $table->rememberToken();
            $table->timestamps();
		});

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

}
