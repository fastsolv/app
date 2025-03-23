<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Carbon\Carbon;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'id' => 1,
                'first_name' => 'Admin',
                'last_name' => '1',
                'email' => 'admin@modulespanel.com',
                'password' => Hash::make('admin1234'),
                'role' => 'admin',
                'status_id' => 1,
                'phone' => '9539909474',
                'address_1' => 'Koduvally',
                'address_2' => 'Kpoyil',
                'postal_code' => 673572,
                'city' => 'Kozhikode',
                'state_id' => '100',
                'country_id' => '2',
                'currency' => 'USD',
                'email_verified_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'id' => 2,
                'first_name' => 's_user',
                'last_name' => '2',
                'email' => 'user@modulespanel.com',
                'password' => Hash::make('git'),
                'role' => 'user',
                'status_id' => 2,
                'phone' => '9539909474',
                'address_1' => 'Koduvally',
                'address_2' => 'Kpoyil',
                'city' => 'Kozhikode',
                'postal_code' => 673572,
                'state_id' => '100',
                'country_id' => '101',
                'currency' => 'USD',
                'email_verified_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ]
        ]);
    }
}
