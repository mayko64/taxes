<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Task;

class CreateTasksTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tasks', function(Blueprint $table)
		{
			$table->increments('id');
			$table->enum('type', array_keys(Task::getTypes()));
			$table->enum('group', array_keys(Task::getGroups()));
			$table->enum('period', array_keys(Task::getPeriods()));
			$table->enum('pay_strategy', array_keys(Task::getStrategies()));
			$table->boolean('is_cummulative')->default(false);
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
		Schema::drop('tasks');
	}

}
