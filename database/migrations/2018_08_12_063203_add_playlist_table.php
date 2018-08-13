<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPlaylistTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
     public function up()
       {
           Schema::create('playlis', function (Blueprint $table) {
               $table->increments('id');
               $table->integer('id_user')->unsigned();
               $table->foreign ('id_user')->references('id')->on('users')->Ondelete ('cascade');
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
        Schema::dropIfExists('playlis');
    }
}
