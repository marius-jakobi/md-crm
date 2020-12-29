<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class TicketController extends Controller
{
    public function show(string $id)
    {
        $ticket = Ticket::findOrFail($id);

        $this->authorize('view', $ticket);

        return view('tickets.show', ['ticket' => $ticket]);
    }

    public function create(string $id)
    {
        return view('tickets.create', [
            'customer' => Customer::findOrFail($id),
            'receivers' => User::all()->sortBy('lastname'),
        ]);
    }

    /**
     * @param Request $request
     * @param string $id Customer ID
     */
    public function store(Request $request, string $id) {
        $this->authorize('create', Ticket::class);

        $customer = Customer::findOrFail($id);

        $validator = Validator::make($request->input(), Ticket::validationRules());

        if ($validator->fails()) {
            return redirect(route('ticket.create', ['id' => $id]))
                ->withErrors($validator)
                ->withInput();
        }

        $ticket = new Ticket($request->input());
        $ticket->customer_id = $customer->id;
        $ticket->creator_id = Auth::user()->id;
        $ticket->save();

        return redirect(route('customer.show', ['id' => $customer->id]))
            ->with('success', 'Das Ticket wurde erstellt.');
    }
}
