<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();

            $table->string('title');
            $table->dateTime('start');
            $table->dateTime('end');
            
            $table->string('color');
            $table->string('textColor');

            $table->string('description')->nullable();
            $table->integer('assigned_to')->default(0); //All
            $table->integer('assigned_by');
            $table->boolean('is_completed')->default(false);
            $table->integer('request_time_off_id')->default(0); // 0 for not requested
            $table->integer('confirm_time_off_id')->default(0); // not requested or not confirmed.

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
        Schema::dropIfExists('tasks');
    }
}
