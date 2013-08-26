<?php

class Create_Closed_Table {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('closed', function($table){
			$table->increments('id');
			$table->string('email');
			$table->string('mem_ip');
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
		Schema::drop('closed');
	}

}