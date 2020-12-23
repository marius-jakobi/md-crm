@extends('layouts.app')

@section('title', 'Ticket')

@section('content')
    <div class="row">
        <div class="col-sm-12 col-md-6">
            <h1>Ticket-Details</h1>
            <p>ID: {{ $ticket->id }}</p>
            <p>erstellt: {{ $ticket->created_at }}</p>
            <p>zuletzt geändert: {{ $ticket->updated_at }}</p>
        </div>
        <div class="col-sm-12 col-md-6">
            @if($ticket->shippingAddress)
                <h2>Lieferadresse</h2>
                <p>
                    {{ $ticket->shippingAddress->name }}<br/>
                    {{ $ticket->shippingAddress->street }}<br/>
                    {{ $ticket->shippingAddress->zip }}
                    {{ $ticket->shippingAddress->city }}
                </p>
            @endif
        </div>
    </div>
    <hr/>
    <p>Ersteller: {{ $ticket->creatorName() }}</p>
    <p>Besitzer: {{ $ticket->receiverName() }}</p>
    <p>Status: <span class="badge badge-{{ $ticket->getStatusClass() }} text-uppercase">{{ $ticket->statusText() }}</span></p>
    <p>Betreff: {{ $ticket->subject }}</p>
    <p>Ansprechpartner: {{ $ticket->contact_name }}</p>
    <p>Telefon: {{ $ticket->contact_phone }}</p>
    <p>E-Mail: <a href="mailto:{{ $ticket->contact_mail }}?subject=Ticket {{ $ticket->id }}">{{ $ticket->contact_mail }}</a></p>
    <textarea class="form-control" rows="8" readonly>{{ $ticket->text }}</textarea>
@endsection
