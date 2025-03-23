<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->uuid('uuid');
            $table->primary('uuid');
            
            $table->bigInteger('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')
                ->onDelete('cascade');

            $table->uuid('order_id');
            $table->foreign('order_id')->references('uuid')->on('orders')
                ->onDelete('cascade');

            $table->float('amount', 8, 2);
            $table->string('currency');
            $table->dateTime('due_date');
            $table->string('payment_status');
            $table->dateTime('refund_date')->nullable();
            $table->string('gateway', 100)->nullable();
            $table->text('transaction_id')->nullable();
            $table->boolean('is_renew')->default(false);
            $table->boolean('test_mode')->default(false);
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
        Schema::dropIfExists('invoices');
    }
}
