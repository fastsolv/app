<?php

namespace Database\Seeders;
use DB;

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

class GatewayDetailsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('gateway_details')->insert([
                [
                    'id' => 1,
                    'gateway_id' => 2,
                    'name' => 'stripe_key',
                    'display_name' => 'Stipe key',
                    'type' => 'text',
                    'description' => 'Some texts',
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
                ],
                [
                    'id' => 2,
                    'gateway_id' => 2,
                    'name' => 'stripe_secret',
                    'display_name' => 'Stripe secret key',
                    'type' => 'password',
                    'description' => 'Some texts',
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
                ],
                [
                    'id' => 3,
                    'gateway_id' => 1,
                    'name' => 'paypal_client_id',
                    'description' => 'Some texts',
                    'type' => 'text',
                    'display_name' => 'Client ID',
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
                ],
                [
                    'id' => 4,
                    'gateway_id' => 1,
                    'name' => 'paypal_client_secret',
                    'description' => 'Some texts',
                    'type' => 'password',
                    'display_name' => 'Client secret',
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
                ],
                [
                    'id' => 5,
                    'gateway_id' => 1,
                    'name' => 'paypal_api_username',
                    'description' => 'Some texts',
                    'type' => 'text',
                    'display_name' => 'API username',
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
                ],
                [
                    'id' => 6,
                    'gateway_id' => 1,
                    'name' => 'paypal_api_password',
                    'description' => 'Some texts',
                    'type' => 'password',
                    'display_name' => 'API password',
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
                ],
                [
                    'id' => 7,
                    'gateway_id' => 1,
                    'name' => 'paypal_api_signature',
                    'description' => 'Some texts',
                    'type' => 'password',
                    'display_name' => 'API signature',
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
                ],
                [
                    'id' => 8,
                    'gateway_id' => 3,
                    'name' => 'mollie_key',
                    'description' => 'Some texts',
                    'type' => 'password',
                    'display_name' => 'Mollie key',
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
                ],
            ]);
    }
}
