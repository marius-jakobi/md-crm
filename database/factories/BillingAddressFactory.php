<?php

namespace Database\Factories;

use App\Models\BillingAddress;
use Illuminate\Database\Eloquent\Factories\Factory;

class BillingAddressFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = BillingAddress::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->company,
            'street' => $this->faker->streetAddress,
            'po_box' => $this->faker->randomNumber(4),
            'zip' => $this->faker->postcode,
            'city' => $this->faker->city
        ];
    }
}
