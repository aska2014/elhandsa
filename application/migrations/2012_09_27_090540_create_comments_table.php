<?php

class Create_Comments_Table {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('comments', function($table)
		{
			$table->increments('id');
			$table->integer('post_id');
			$table->integer('member_id');
			$table->text('body');
			$table->string('likes'); // Array
			$table->timestamps();

			$table->foreign('member_id')->references('id')->on('members')->on_delete('cascade');
			$table->foreign('post_id')->references('id')->on('posts')->on_delete('cascade');
		});
	}

	/**
	 * Revert the changes to the database.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('comments');
	}

}