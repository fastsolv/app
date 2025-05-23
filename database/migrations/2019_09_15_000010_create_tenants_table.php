<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTenantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('tenants', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->boolean('status')->default(0);
            // your custom columns may go here

            $table->timestamps();
            $table->json('data')->nullable();
        });
        \DB::statement("ALTER Table tenants add tenant_id INTEGER NOT NULL UNIQUE AUTO_INCREMENT  AFTER id;");
        \DB::statement("ALTER Table tenants  AUTO_INCREMENT  = 100001 ;");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('tenants');
    }
}
