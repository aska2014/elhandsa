<?php

class Create_Instructors_Table {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('instructors', function($table)
		{
			$table->increments('id');
			$table->string('ar_name');
			$table->string('ar_group');
			$table->string('ar_type');
			$table->integer('add_by_user')->default(0);
			$table->integer('type');
			$table->timestamps();
		});
	}

	/**
	 * Revert the changes to the database.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('instructors');
	}

}