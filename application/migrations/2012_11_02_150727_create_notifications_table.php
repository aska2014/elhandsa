<?php

class Create_Notifications_Table {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('notifications', function($table)
		{
			$table->increments('id');
			$table->integer('group_id');
			$table->integer('member_id');
			$table->string('title');
			$table->text('body');
			$table->string('type');
			$table->timestamps();

			$table->foreign('member_id')->references('id')->on('members')->on_delete('CASCADE');
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
		//
	}

}