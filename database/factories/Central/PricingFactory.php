<?php

namespace Database\Factories\Central;

use App\Models\Central\Pricing;
use App\Models\Central\Plan;
use App\Models\Central\Currency;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Carbon\Carbon;

class PricingFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Pricing::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'id' => $this->faker->unique()->randomNumber(),
            // create a new user
            'plan_id' =>  function () {
                return Plan::all()->random()->uuid;
             },
            // create a new order
            'term' => $this->faker->randomNumber(2),
            'period' => $this->faker->randomElement(['Day(s)', 'Month(s)']),
            'price' => $this->faker->randomNumber(2),
            'currency_id' =>  function () {
                return Currency::all()->random()->id;
             },
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ];
    }
}
