<?php

class Create_Sheets_Table {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('sheets', function($table)
		{
			$table->increments('id');
			$table->integer('member_id')->nullable();
			$table->integer('group_id');
			$table->integer('material_id');
			$table->string('name');
			$table->text('description');
			$table->string('file_url');
			$table->date('deliver_at');
			$table->string('finished'); // array
			$table->timestamps();

			$table->foreign('group_id')->references('id')->on('groups')->on_delete('NO ACTION');
			$table->foreign('member_id')->references('id')->on('members')->on_delete('SET NULL');
			$table->foreign('material_id')->references('id')->on('materials')->on_delete('CASCADE');
		});
	}

	/**
	 * Revert the changes to the database.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('sheets');
	}

}