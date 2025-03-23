<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGatewayDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gateway_details', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('gateway_id')->unsigned();
            $table->foreign('gateway_id')->references('id')->on('gateways')
                ->onDelete('cascade');
            $table->string('name');
            $table->string('display_name', 100)->unique();
            $table->string('type')->default('text');
            $table->text('value')->nullable();
            $table->text('description');
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
        Schema::dropIfExists('gateway_details');
    }
}
