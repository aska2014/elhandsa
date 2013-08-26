<?php

class Create_Groups_Table {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('groups', function($table)
		{
			$table->increments('id');
			$table->string('department');
			$table->string('department_ar');
			$table->integer('year');
			$table->string('mediafire_folder');
			$table->string('password');
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
		Schema::drop('groups');
	}

}