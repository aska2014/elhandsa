<?php

class Create_Materials_Table {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('materials', function($table)
		{
			$table->increments('id');
			$table->integer('doctor_id')->nullable();
			$table->integer('professor_id')->nullable();
			$table->integer('group_id');
			$table->string('name');
			$table->text('description');
			$table->timestamps();

			$table->foreign('doctor_id')->references('id')->on('instructors')->on_delete('SET NULL');
			$table->foreign('professor_id')->references('id')->on('instructors')->on_delete('SET NULL');
			$table->foreign('group_id')->references('id')->on('groups')->on_delete('cascade');
		});
	}

	/**
	 * Revert the changes to the database.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('materials');
	}

}