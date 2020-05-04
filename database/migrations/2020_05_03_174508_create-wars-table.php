<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wars', function(Blueprint $table){
            $table->id();
            $table->string('name');
            $table->json('kill_messages');
            $table->json('players_alive')->nullable();
            $table->json('day_number')->nullable();
            $table->boolean('is_finished');
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
