<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tickets', function (Blueprint $table) {
            $table->text('rating')->after('message')->nullable();
            $table->uuid('product_id')->nullable()
            ->after('department_id');
            $table->foreign('product_id')->references('uuid')->on('products')
            ->onDelete('cascade');
            $table->text('feedback_text')->after('product_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tickets', function (Blueprint $table) {
            $table->dropColumn('rating');
            $table->dropColumn('product_id');
            $table->dropColumn('feedback_text');

        });
    }
}
