<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\TicketResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class TicketResponseController extends Controller
{
    public function create(Request $request, string $id) {
        $ticket = Ticket::findOrFail($id);

        $this->authorize('create', TicketResponse::class);
        $this->authorize('update', $ticket);

        $validator = Validator::make($request->input(), TicketResponse::validationRules());
        $route = route('ticket.show', ['id' => $ticket->id]);

        if ($validator->fails()) {
            return redirect($route)
                ->withErrors($validator);
        }

        $ticketResponse = new TicketResponse($request->only(['text']));
        $ticketResponse->ticket_id = $ticket->id;
        $ticketResponse->creator_id = Auth::user()->id;
        $ticketResponse->save();

        return redirect($route)->with('success', 'Die Antwort wurde erstellt.');
    }
}
