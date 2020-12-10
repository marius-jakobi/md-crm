<?php

namespace Database\Seeders;

use App\Models\BillingAddress;
use App\Models\Customer;
use App\Models\ShippingAddress;
use Illuminate\Database\Seeder;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Customer::factory()
            ->times(20)
            ->has(BillingAddress::factory()->count(1))
            ->has(ShippingAddress::factory()->count(3))
            ->create();
    }
}
