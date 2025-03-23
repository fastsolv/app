<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class TenantDatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            Tenant\StatusesTableSeeder::class,
            Tenant\CountrySeeder::class,
            Tenant\StateSeeder::class,
            Tenant\UsersTableSeeder::class,
            Tenant\TicketStatusSeeder::class,
            Tenant\TicketUrgencySeeder::class,
            Tenant\DepartmentSeeder::class,
            //Tenant\TicketSeeder::class,
            Tenant\LanguageSeeder::class,
            Tenant\SettingsSeeder::class,
            Tenant\PermissionSeeder::class,
            Tenant\EmailTemplateSeeder::class,
            Tenant\TagTableSeeder::class,
            Tenant\CannedResponseTableSeeder::class,
            // Tenant\FaqCategoryTableSeeder::class,
            // Tenant\KbCategoryTableSeeder::class,
            // Tenant\KbArticleSeeder::class,
            // Tenant\FaqTableSeeder::class,
            Tenant\RolesSeeder::class,
            Tenant\ActionPermissionSeeder::class,
            Tenant\AnnouncementsSeeder::class
       ]);
    }
}
