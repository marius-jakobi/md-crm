<?php

namespace Database\Seeders;

use App\Models\Customer;
use App\Models\Ticket;
use App\Models\TicketResponse;
use App\Models\TicketStatus;
use Illuminate\Database\Seeder;

class TicketSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach(Customer::all() as $customer) {
            $ticket = Ticket::factory()->make();
            $ticket->customer_id = $customer->id;
            $ticket->status = TicketStatus::OPEN;
            $ticket->save();

            for ($i = 0; $i < 2; $i++) {
                $response = TicketResponse::factory()->make();
                $response->ticket_id = $ticket->id;
                $response->save();
            }
        }
    }
}
