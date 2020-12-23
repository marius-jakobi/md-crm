<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Ticket;
use App\Models\TicketStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CustomerController extends Controller
{
    public function index() {
        $this->authorize('viewAny', Customer::class);

        $customers = Customer::paginate(10);

        return view('customers.index', ['customers' => $customers]);
    }

    public function show(string $id) {
        $customer = Customer::findOrFail($id);

        $this->authorize('view', $customer);

        $tickets = DB::table('tickets')
            ->where('tickets.customer_id', '=', $id)
            ->where('tickets.status', '=', TicketStatus::OPEN)
            ->leftJoin('shipping_addresses', 'shipping_addresses.id', '=', 'tickets.shipping_address_id')
            ->get(['tickets.*', 'shipping_addresses.name as shipping_address_name']);

        return view('customers.show', ['customer' => $customer, 'tickets' => $tickets]);
    }
}
