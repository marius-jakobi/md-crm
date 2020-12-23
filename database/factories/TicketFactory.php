<?php

namespace Database\Factories;

use App\Models\Customer;
use App\Models\ShippingAddress;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class TicketFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Ticket::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'creator_id' => User::all()->random(1)->first()->id,
            'receiver_id' => User::all()->random(1)->first()->id,
            'shipping_address_id' => ShippingAddress::all()->random(1)->first()->id,
            'status' => $this->faker->numberBetween(0, 2),
            'subject' => $this->faker->text(32),
            'contact_name' => $this->faker->name(),
            'contact_phone' => $this->faker->phoneNumber(),
            'contact_mail' => $this->faker->safeEmail(),
            'text' => $this->faker->text(200),
        ];
    }
}
