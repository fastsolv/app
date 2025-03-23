<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hooks', function (Blueprint $table) {
            $table->uuid('uuid');
            $table->primary('uuid');
            $table->string('rel_id')->references('uuid')->on('addons')->onDelete('cascade');
            $table->string('name');
            $table->string('type')->nullable();
            $table->string('class');
            $table->tinyInteger('status')->default(1);
            $table->string('priority');
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
        Schema::dropIfExists('hooks');
    }
}
