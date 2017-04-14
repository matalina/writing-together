<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('messages',function(Blueprint $table) 
        {
            $table->increments('id');
            
            $table->string('title')->nullable();
            $table->integer('user_id')->unsigned();
            $table->integer('message_id')->unsigned()->nullable();
            
            $table->string('participants'); // json string of user_ids
            
            $table->text('body');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('messages');
    }
}
