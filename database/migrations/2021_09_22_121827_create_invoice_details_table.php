<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoiceDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoice_details', function (Blueprint $table) {
            $table->uuid('uuid');
            $table->primary('uuid');
            
            $table->uuid('invoice_id');
            $table->foreign('invoice_id')->references('uuid')->on('invoices')
                ->onDelete('cascade');

            $table->uuid('service_id');
            $table->foreign('service_id')->references('uuid')->on('services')
                ->onDelete('cascade');

            $table->float('amount', 8, 2);
            $table->string('currency');
            $table->text('description')->nullable();
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
        Schema::dropIfExists('invoice_details');
    }
}
