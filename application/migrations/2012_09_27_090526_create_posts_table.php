<?php

class Create_Posts_Table {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('posts', function ($table)
		{
			$table->increments('id');
			$table->integer('group_id');
			$table->integer('member_id');
			$table->text('body');
			$table->string('likes'); // array(mem_id1, mem_id2 ,...)
			$table->integer('type'); // 0 = Students, 1 = Doctors and Instructors
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
		Schema::drop('posts');
	}

}