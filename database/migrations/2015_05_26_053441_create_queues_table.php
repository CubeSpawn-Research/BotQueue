<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class CreateQueuesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		if(Schema::hasTable('queues')) {
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
		Schema::drop('queues');
	}

	private function createTable()
	{
		Schema::create('queues', function (Blueprint $table) {
			$table->increments('id');
			$table->integer('user_id')->unsigned();
			$table->string('name');
			$table->integer('delay')->unsigned();
		});
	}

	private function convertTable()
	{
		Schema::table('queues', function(Blueprint $table) {
			$table->dropForeign('queues_ibfk_1');
			$table->dropIndex('user_id');
		});
	}

}
