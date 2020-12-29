<?php

namespace Database\Factories;

use App\Models\TicketResponse;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class TicketResponseFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = TicketResponse::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'text' => $this->faker->text(),
            'creator_id' => User::all()->random(1)->first()->id,
        ];
    }
}
