<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientGroupEmailCampaignsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('client_group_email_campaigns', function (Blueprint $table) {
            $table->uuid('uuid');
            $table->primary('uuid');

            $table->uuid('template_id');
            $table->foreign('template_id')->references('uuid')->on('email_templates')
                ->onDelete('cascade');
            
            $table->bigInteger('department_id')->unsigned();
            $table->foreign('department_id')->references('id')->on('departments')
                ->onDelete('cascade');
            
            $table->timestamp('send_at');
            $table->uuid('client_group_id');
            $table->foreign('client_group_id')->references('uuid')->on('client_groups')
                ->onDelete('cascade');

            $table->string('status')->default('pending');
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
        Schema::dropIfExists('client_group_email_campaigns');
    }
}
