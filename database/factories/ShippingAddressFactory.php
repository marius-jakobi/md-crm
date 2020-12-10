<?php

namespace Database\Factories;

use App\Models\Model;
use App\Models\ShippingAddress;
use Illuminate\Database\Eloquent\Factories\Factory;

class ShippingAddressFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ShippingAddress::class;

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
            'zip' => $this->faker->postcode,
            'city' => $this->faker->city
        ];
    }
}
