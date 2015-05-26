<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class CreateActivitiesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		if(Schema::hasTable('activities')) {
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
		Schema::drop('activities');
	}

	private function convertTable()
	{
		Schema::table('activities', function(Blueprint $table) {
			$table->dropForeign('activities_ibfk_1');
			$table->dropIndex('user_id');
			$table->renameColumn('action_date', 'created_at');
			$table->dateTime('updated_at');
		});
	}

	private function createTable()
	{
		Schema::create('activities', function (Blueprint $table) {
			$table->increments('id');
			$table->integer('user_id')->unsigned();
			$table->text('activity');
			$table->dateTime('created_at');
			$table->dateTime('updated_at');
		});
	}

}
