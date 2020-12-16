<?php

namespace Database\Factories;

use App\Models\CustomerContact;
use Illuminate\Database\Eloquent\Factories\Factory;

class CustomerContactFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = CustomerContact::class;

    private $positions = [
        'CEO',
        'GF',
        'Abteilungsleiter',
        'Einkäufer',
    ];

    private $divisions = [
        'Geschäftsleitung',
        'Einkauf',
        'Vertrieb',
        'Marketing',
    ];

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'phone' => $this->faker->phoneNumber,
            'email' => $this->faker->safeEmail,
            'mobile' => $this->faker->phoneNumber,
            'position' => $this->faker->randomElement($this->positions),
            'division' => $this->faker->randomElement($this->divisions),
        ];
    }
}
