<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUpgradeServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('upgrade_services', function (Blueprint $table) {
            $table->uuid('uuid');
            $table->primary('uuid');
            
            $table->uuid('service_id');
            $table->foreign('service_id')->references('uuid')->on('services')
                ->onDelete('cascade');
            
            $table->bigInteger('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')
                    ->onDelete('cascade');

            $table->uuid('order_id');
            $table->foreign('order_id')->references('uuid')->on('orders')
                ->onDelete('cascade');
            
            $table->uuid('old_plan_id');
            $table->foreign('old_plan_id')->references('uuid')->on('plans')
                ->onDelete('cascade');

            $table->bigInteger('old_pricing_id')->unsigned();
            $table->foreign('old_pricing_id')->references('id')->on('pricings')
                    ->onDelete('cascade');

            $table->uuid('new_plan_id');
            $table->foreign('new_plan_id')->references('uuid')->on('plans')
                    ->onDelete('cascade');

            $table->bigInteger('new_pricing_id')->unsigned();
            $table->foreign('new_pricing_id')->references('id')->on('pricings')
                    ->onDelete('cascade');

            $table->float('amount', 8, 2);
            $table->string('currency');
            $table->string('payment_status');
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
        Schema::dropIfExists('upgrade_services');
    }
}
