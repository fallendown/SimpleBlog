<?php

class Create_Users_Table {    

	public function up()
    {
		Schema::create('users', function($table) {
			$table->increments('id');
			$table->string('username', 128);
			$table->string('email', 128);
			$table->string('password', 64);
			$table->timestamps();
	});

    }    

	public function down()
    {
		Schema::drop('users');

    }

}