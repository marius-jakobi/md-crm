<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    public function show(string $id)
    {
        return view('tickets.show', ['ticket' => Ticket::findOrFail($id)]);
    }
}
