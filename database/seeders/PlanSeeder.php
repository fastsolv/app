<?php

namespace Database\Seeders;
use DB;

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use App\Helpers\Uuid;

class PlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('plans')->insert([
                [
                    'uuid' => Uuid::getUuid(),
                    'name' => 'Trial',
                    'description' => "Choose your Starter pack",
                    'status' => true,
                    'department_count' => 2,
                    'staffs_qty' => 2,
                    'user_qty' => 2,
                    'ticket_qty' => 1000,
                    'display_order' => 1,
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
                ],
                [
                    'uuid' => Uuid::getUuid(),
                    'name' => 'Starter',
                    'description' => "Choose your Starter pack",
                    'status' => true,
                    'department_count' => 2,
                    'staffs_qty' => 2,
                    'user_qty' => 2,
                    'ticket_qty' => 1000,
                    'display_order' => 2,
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
                ],
                [
                    'uuid' => Uuid::getUuid(),
                    'name' => 'Premium',
                    'description' => "Choose your Starter pack",
                    'status' => true,
                    'department_count' => 10,
                    'staffs_qty' => 10,
                    'user_qty' => 100,
                    'ticket_qty' => 10000,
                    'display_order' => 3,
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
                ],
                [
                    'uuid' => Uuid::getUuid(),
                    'name' => 'Enterprise',
                    'description' => "Choose your Starter pack",
                    'status' => true,
                    'department_count' => null,
                    'staffs_qty' => null,
                    'user_qty' => null,
                    'ticket_qty' => null,
                    'display_order' => 4,
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
                ],
            ]);
    }
}
