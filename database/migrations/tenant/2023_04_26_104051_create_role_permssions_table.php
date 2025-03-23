<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRolePermssionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('role_permissions', function (Blueprint $table) {
            $table->uuid('uuid');
            $table->primary('uuid');
             
            $table->uuid('role_id');
            $table->foreign('role_id')->references('uuid')->on('roles')
                ->onDelete('cascade');

                $table->bigInteger('permission_id')->unsigned();
                $table->foreign('permission_id')->references('id')->on('action_permissions')
                    ->onDelete('cascade');

            $table->boolean('is_allowed')->default(false);
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
        Schema::dropIfExists('role_permissions');
    }
}
