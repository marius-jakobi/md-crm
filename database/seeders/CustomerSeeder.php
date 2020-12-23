<?php

namespace Database\Seeders;

use App\Models\BillingAddress;
use App\Models\Customer;
use App\Models\CustomerContact;
use App\Models\ShippingAddress;
use App\Models\Ticket;
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
            ->has(CustomerContact::factory()->count(2))
            ->has(Ticket::factory()->count(4))
            ->create();
    }
}
