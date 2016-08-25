<?php

use App\Facades\Migrate;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBotsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('bots', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('oauth_token_id')->nullable();
            $table->string('name');
            $table->string('type');
            $table->string('status')->default('offline');
            $table->integer('job_id')->nullable();
            $table->text('error_text')->nullable();
            $table->integer('slice_config_id')->nullable();
            $table->longText('temperature_data')->nullable();
            $table->string('driver_name')->default('printcore');
            $table->text('driver_config')->nullable();
            $table->integer('webcam_image_id')->nullable();
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
        Schema::drop('bots');
    }
}
