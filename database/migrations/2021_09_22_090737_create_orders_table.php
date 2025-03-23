<?php

// use DB;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('orders');
        Schema::create('orders', function (Blueprint $table) {
            $table->uuid('uuid');
            $table->primary('uuid');
            $table->uuid('parent_order_id')->default(0);

            $table->bigInteger('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')
                ->onDelete('cascade');

            $table->float('amount', 8, 2);
            $table->string('currency');

            $table->string('gateway', 100)->nullable();
            $table->string('status', 100)->default('fresh');
            $table->timestamps();

        });
        \DB::statement("ALTER Table orders add order_id INTEGER NOT NULL UNIQUE AUTO_INCREMENT  AFTER uuid;");
        \DB::statement("ALTER Table orders  AUTO_INCREMENT  = 100001 ;");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
