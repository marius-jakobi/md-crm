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
            <h2>Lieferadresse</h2>
            @if($ticket->shippingAddress)
                <p>
                    {{ $ticket->shippingAddress->name }}<br/>
                    {{ $ticket->shippingAddress->street }}<br/>
                    {{ $ticket->shippingAddress->zip }}
                    {{ $ticket->shippingAddress->city }}
                </p>
            @else
                <p>nicht angegeben</p>
            @endif
        </div>
    </div>
    <hr/>
    <p>Ersteller: {{ $ticket->creatorName() }}</p>
    <p>Besitzer: {{ $ticket->receiverName() }}</p>
    <p>
        Status:
        <span class="badge badge-{{ $ticket->getStatusClass() }} text-uppercase">{{ $ticket->statusText() }}</span>
    </p>
    <p>Betreff: {{ $ticket->subject }}</p>
    <p>Ansprechpartner: {{ $ticket->contact_name }}</p>
    <p>Telefon: {{ $ticket->contact_phone }}</p>
    <p>
        E-Mail:
        <a href="mailto:{{ $ticket->contact_mail }}?subject=Ticket {{ $ticket->id }}">{{ $ticket->contact_mail }}</a>
    </p>
    <textarea class="form-control" rows="8" readonly>{{ $ticket->text }}</textarea>
    @can('viewAny', \App\Models\TicketResponse::class)
        <hr/>
        <h2>Antworten ({{ $ticket->ticketResponses->count() }})</h2>
        @if($ticket->ticketResponses->count() == 0)
            <div class="alert bg-info">Dieses Ticket enthält keine Antworten.</div>
        @else
            @foreach($ticket->ticketResponses as $response)
                <div class="card bg-light mb-3">
                    <div class="card-header">
                        {{ $response->creator->fullName() }} am {{ $response->created_at }}
                    </div>
                    <div class="card-body">
                        <div class="card-text">
                            <span style="white-space: pre-line">{{ $response->text }}</span>
                            <p class="text-right text-secondary mb-0">#{{ $response->id }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        @endif
    @endcan
    @if(Auth::user()->can('create', App\Models\TicketResponse::class) && Auth::user()->can('update', $ticket))
        <hr/>
        <h2>Antwort erstellen</h2>
        <x-forms.form action="{{ route('ticket.response.create', ['id' => $ticket->id]) }}" method="post">
            @csrf
            <x-forms.textarea name="text" caption="Text"></x-forms.textarea>
            <x-forms.submit-button caption="Antwort erstellen"></x-forms.submit-button>
        </x-forms.form>
    @endif
@endsection
