<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTokenTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//
		Schema::create('token', function(Blueprint $table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id');          
            $table->text('token', 255);	
            $table->string('email', 255);
            
            $table->datetime('created_at');
            $table->datetime('updated_at');
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		//
		Schema::drop('token');
        DB::table('token')->delete();
	}

}
