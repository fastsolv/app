<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientGroupEmailCampaignLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('client_group_email_campaign_logs', function (Blueprint $table) {
            $table->uuid('uuid');
            $table->primary('uuid');

            $table->bigInteger('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')
                ->onDelete('cascade');

            $table->uuid('campaign_id');
            $table->foreign('campaign_id')->references('uuid')->on('client_group_email_campaigns')
                    ->onDelete('cascade');

            $table->boolean('status');
            $table->timestamp('send_at');
            
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
        Schema::dropIfExists('client_group_email_campaign_logs');
    }
}
