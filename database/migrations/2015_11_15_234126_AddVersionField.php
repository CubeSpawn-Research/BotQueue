<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddVersionField extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $this->addColumn('users');
        $this->addColumn('bots');
        $this->addColumn('jobs');
        $this->addColumn('queues');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $this->dropColumn('users');
        $this->dropColumn('bots');
        $this->dropColumn('jobs');
        $this->dropColumn('queues');
    }

    private function addColumn($table)
    {
        Schema::table($table, function(Blueprint $table) {
            $table->integer('version')->default(0);
        });
    }

    private function dropColumn($table)
    {
        Schema::table($table, function(BluePrint $table) {
            $table->dropColumn('version');
        });
    }
}
