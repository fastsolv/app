<?php

namespace Database\Seeders;

use Database\Seeders\Tenant\RolesSeeder;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            StatusesTableSeeder::class,
            CountrySeeder::class,
            StateSeeder::class,
            SettingsSeeder::class,
            UsersTableSeeder::class,
            LanguageSeeder::class,
            GatewaySeeder::class,
            GatewayDetailsSeeder::class,
            CurrencySeeder::class,
            PlanSeeder::class,
       ]);
    }
}
