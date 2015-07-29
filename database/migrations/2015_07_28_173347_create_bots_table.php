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
		if(Schema::hasTable('bots')) {
			$this->convertTable();
		} else {
			$this->createTable();
		}
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

	protected function createTable()
	{
		Schema::create('bots', function (Blueprint $table) {
			$table->increments('id');
			$table->integer('user_id');
			$table->integer('oauth_token_id')->nullable();
			$table->string('name');
			$table->string('model');
			$table->string('manufacturer');
			$table->string('status')->default('offline');
			$table->integer('job_id')->nullable();
			$table->text('error_text')->nullable();
			$table->integer('slice_config_id')->nullable();
			$table->longText('temperature_data')->nullable();
			$table->string('driver_name')->default('printcore');
			$table->text('driver_config')->nullable();
			$table->integer('webcam_image_id')->nullable();
			$table->dateTime('created_at');
			$table->dateTime('updated_at');
		});
	}

	private function convertTable()
	{
		#todo Check that this works with MySQL
		Migrate::convertEnum('bots', 'status', 'offline');

		Schema::table('bots', function(Blueprint $table) {
			$table->dropIndex('identifier');
			$table->dropIndex('job_id');
			$table->dropIndex('oauth_token_id');
			$table->dropIndex('slice_config_id');
			$table->dropIndex('slice_engine_id');
			$table->dropIndex('status');
			$table->dropIndex('name');

			$table->renameColumn('last_seen', 'updated_at');
			$table->dateTime('created_at');

			$table->dropColumn('client_name');
			$table->dropColumn('client_uid');
			$table->dropColumn('identifier');
			$table->dropColumn('client_version');
			$table->dropColumn('electronics');
			$table->dropColumn('firmware');
			$table->dropColumn('extruder');
			$table->dropColumn('slice_engine_id');
			$table->dropColumn('remote_ip');
			$table->dropColumn('local_ip');

			$table->integer('oauth_token_id')->nullable()->change();
			$table->string('status')->default('offline')->change();
			$table->integer('job_id')->nullable()->change();
			$table->text('error_text')->nullable()->change();
			$table->integer('slice_config_id')->nullable()->change();
			$table->longText('temperature_data')->nullable()->change();
			$table->text('driver_config')->nullable()->change();
			$table->integer('webcam_image_id')->nullable()->change();
		});
	}

}
