<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//
		Schema::create('users', function(Blueprint $table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id');          
            $table->string('email', 255);           
            $table->datetime('created_at');
            $table->datetime('updated_at');
        });

        DB::table('users')->insert(
            array(  
                    array(  'email'=> 'admin@gmail.com',
                            'created_at'=> $date = date('Y-m-d H:i:s')), 
            ));
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		//
		Schema::drop('users');
        DB::table('users')->delete();
	}

}
