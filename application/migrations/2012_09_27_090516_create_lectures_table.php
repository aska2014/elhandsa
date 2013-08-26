<?php

class Create_Lectures_Table {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('lectures', function ($table)
		{
			$table->increments('id');
			$table->integer('group_id');
			$table->integer('material_id');
			$table->string('day');
			$table->decimal('start_at', 5, 2);
			$table->decimal('end_at'  , 5, 2);
			$table->string('session');
			$table->string('place');
			$table->string('state'); // '', 'canceled', 'delayed'
			$table->string('type'); // 'lecture' , 'section'
			$table->date('canceled_date');
			$table->date('delayed_date');
			$table->decimal('delayed_start_at', 5, 2);
			$table->decimal('delayed_end_at'  , 5, 2);
			$table->timestamps();

			$table->foreign('material_id')->references('id')->on('materials')->on_delete('CASCADE');
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
		Schema::drop('lectures');
	}

}