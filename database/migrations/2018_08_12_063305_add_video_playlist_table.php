<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddVideoPlaylistTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
     public function up()
     {
         Schema::create('videoplaylist', function (Blueprint $table) {
             $table->increments('id');
             $table->string('nombre_video');
             $table->string('url_video');
             $table->integer('id_playlis')->unsigned();
             $table->foreign ('id_playlis')->references('id')->on('playlis')->Ondelete ('cascade');
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
        //
    }
}
