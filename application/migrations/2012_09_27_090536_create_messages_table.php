<?php

class Create_Messages_Table {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('messages',function($table)
		{
			$table->increments('id');
			$table->integer('member_id');
			$table->integer('to_id');
			$table->text('body');
			$table->integer('seen'); // 0 or 1
			$table->timestamps();

			$table->foreign('member_id')->references('id')->on('members')->on_delete('CASCADE');
		});
	}

	/**
	 * Revert the changes to the database.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('messages');
	}

}