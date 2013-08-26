<?php

class Create_Timetables_Table {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('timetables', function($table)
		{
			$table->increments('id');
			$table->integer('group_id');
			$table->string('days_start_at');
			$table->string('days_end_at');
			$table->timestamps();

			$table->foreign('group_id')->references('id')->on('groups')->on_delete('CASCADE');
		});
	}

	/**
	 * Revert the changes to the database.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('timetables');
	}

}