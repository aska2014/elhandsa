<?php

class Create_Members_Table {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('members', function ($table)
		{
			$table->increments('id');
			$table->integer('group_id');
			$table->integer('instructor_id')->nullable();
			$table->string('email');
			$table->string('first_name');
			$table->string('last_name');
			$table->string('password');
			$table->text('about');
			$table->text('status');
			$table->string('cell_phone');
			$table->string('home_town');
			$table->string('hoppies');
			$table->date('birthday');
			$table->integer('type'); // 0 = student, 1 = professor, 2 = doctors
			$table->integer('identity');
			$table->timestamps();

			$table->foreign('group_id')->references('id')->on('groups')->on_delete('NO ACTION');
			$table->foreign('instructor_id')->references('id')->on('instructors')->on_delete('SET NULL');
		});
	}

	/**
	 * Revert the changes to the database.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('members');
	}

}