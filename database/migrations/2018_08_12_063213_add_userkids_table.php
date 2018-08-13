<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUserkidsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
     public function up()
     {
         Schema::create('userskids', function (Blueprint $table) {
             $table->increments('id');
             $table->string('namefull');
             $table->string('username');
             $table->string('age');
             $table->integer('pin');
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
        Schema::dropIfExists('userskids');
    }
}
