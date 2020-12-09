<?php

namespace Database\Factories;

use App\Models\Permission;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class PermissionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Permission::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $entity = Str::random();
        $method = array_rand(['index', 'view', 'create', 'update', 'delete']);

        return [
            'identifier' => "$method-$entity",
            'description' => "can $method a $entity",
        ];
    }
}
