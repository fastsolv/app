<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plans', function (Blueprint $table) {
            $table->uuid('uuid');
            $table->primary('uuid');
            $table->string('name');
            $table->longText('description');
            $table->boolean('status')->default(true);
            $table->integer('department_count')->nullable();
            $table->integer('staffs_qty')->nullable();
            $table->integer('user_qty')->nullable();
            $table->integer('ticket_qty')->nullable();
            $table->integer('display_order')->nullable();
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
        Schema::dropIfExists('plans');
    }
}
