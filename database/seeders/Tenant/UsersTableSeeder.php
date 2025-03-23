<?php

namespace Database\Seeders\Tenant;

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
                'first_name' => 'admin',
                'last_name' => '1',
                'email' => 'admin@modulespanel.com',
                'password' => Hash::make('admin1234'),
                'role' => 'admin',
                'user_type'=>'admin',
                'email_verified_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'id' => 2,
                'first_name' => 'staff 1',
                'last_name' => '1',
                'email' => 'staff@modulespanel.com',
                'password' => Hash::make('staff1234'),
                'role' => 'staff',
                'user_type'=>'internal',
                'email_verified_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'id' => 3,
                'first_name' => 'Aseel',
                'last_name' => '1',
                'email' => 'user@modulespanel.com',
                'password' => Hash::make('user1234'),
                'role' => 'user',
                'user_type'=>'user',
                'email_verified_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ]

        ]);
    }
}
