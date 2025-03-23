<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDepartmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('departments', function (Blueprint $table) {
            $table->id();
            $table->integer('site_id')->default(0);
            $table->string('name', 100)->unique();
            $table->text('description')->nullable();
            $table->string('email', 100)->unique();
            $table->text('host')->nullable();
            $table->text('port')->nullable();
            $table->text('password')->nullable();
            $table->integer('next_message_id')->default(-1);
            $table->text('mail_box')->nullable();
            $table->text('flags')->nullable();
            $table->boolean('imap_status')->default(false);
            $table->text('smtp_host')->nullable();
            $table->text('smtp_port')->nullable();
            $table->text('smtp_password')->nullable();
            $table->text('smtp_encryption')->nullable();
            $table->boolean('smtp_status')->default(false);
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
        Schema::dropIfExists('departments');
    }
}
