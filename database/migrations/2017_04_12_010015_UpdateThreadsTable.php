<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
 
class UpdateThreadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('titles', function(Blueprint $table) 
        {
            $table->integer('rating')->unsigned()->default(1); // E, T, M
            $table->boolean('private')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('titles', function(Blueprint $table) 
        {
            $table->dropColumn('rating');
            $table->dropColumn('private');
        });
    }
}
