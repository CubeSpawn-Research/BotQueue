<?php
/*
	This file is part of BotQueue.

	BotQueue is free software: you can redistribute it and/or modify
	it under the terms of the GNU General Public License as published by
	the Free Software Foundation, either version 3 of the License, or
	(at your option) any later version.

	BotQueue is distributed in the hope that it will be useful,
	but WITHOUT ANY WARRANTY; without even the implied warranty of
	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
	GNU General Public License for more details.

	You should have received a copy of the GNU General Public License
	along with BotQueue.  If not, see <http://www.gnu.org/licenses/>.
  */


namespace App\Helpers;


use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class MigrationHelper {

	public function convertEnum($table, $column_name, $default = null)
	{
		// Copy the enum data over so Doctrine doesn't flip.
		Schema::table($table, function (Blueprint $table) use ($column_name, $default) {
			if(is_null($default)) {
				$table->string($column_name.'_temp');
			} else {
				$table->string($column_name . '_temp')->default($default);
			}
		});
		DB::statement("UPDATE users SET {$column_name}_temp={$column_name}");

		Schema::table($table, function (Blueprint $table) use ($column_name) {
			$table->dropColumn($column_name);
		});

		Schema::table($table, function (Blueprint $table) use ($column_name) {
			$table->renameColumn($column_name.'_temp', $column_name);
		});
	}
}