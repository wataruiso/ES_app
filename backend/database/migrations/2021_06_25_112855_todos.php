<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Todos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('todos', function(Blueprint $table) {
            $table->increments('id');
            $table->char('title', 20);
            $table->longText('description')->nullable();
            $table->foreignId('entry_id')->nullable();
            $table->dateTime('time_to_start');
            $table->dateTime('time_to_end')->nullable();
            $table->boolean('is_done');
            $table->timestamp('created_at');
            $table->timestamp('updated_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('todos');
    }
}
