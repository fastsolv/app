<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('services', function (Blueprint $table) {
            $table->uuid('uuid');
            $table->primary('uuid');

            $table->uuid('order_id');
            $table->foreign('order_id')->references('uuid')->on('orders')
                ->onDelete('cascade');
            
            $table->integer('tenant_id')->nullable();
            $table->foreign('tenant_id')->references('tenant_id')->on('tenants')
                ->onDelete('cascade');
            
            $table->uuid('plan_id');
            $table->foreign('plan_id')->references('uuid')->on('plans')
                ->onDelete('cascade');

            $table->bigInteger('pricing_id')->unsigned();
            $table->foreign('pricing_id')->references('id')->on('pricings')
                    ->onDelete('cascade');
            
            $table->bigInteger('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')
                    ->onDelete('cascade');

            $table->bigInteger('status_id')->unsigned();
            $table->foreign('status_id')->references('id')->on('statuses')
                ->onDelete('cascade');

            $table->dateTime('expiry_date')->nullable();
            $table->dateTime('grace_period')->nullable();
            $table->dateTime('next_invoice_date')->nullable();
            $table->timestamps();
        });
        \DB::statement("ALTER Table services add service_id INTEGER NOT NULL UNIQUE AUTO_INCREMENT  AFTER uuid;");
        \DB::statement("ALTER Table services  AUTO_INCREMENT  = 100001 ;");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('services');
    }
}
