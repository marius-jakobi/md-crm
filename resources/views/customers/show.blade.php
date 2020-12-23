@extends('layouts.app')

@section('title', $customer->name)

@section('content')
    <h1>{{ $customer->name }}</h1>
    <p>erstellt: {{ $customer->created_at }}</p>
    <p>zuletzt geändert: {{ $customer->updated_at }}</p>
    <div class="row">
        @can('viewAny', \App\Models\BillingAddress::class)
            <div class="col-lg-6 col-md-12">
                <h2>Rechnungsadressen</h2>
                @can('create', \App\Models\BillingAddress::class)
                    <a href="{{ route('customers.addresses.billing.create', ['id' => $customer->id]) }}"
                       class="btn btn-primary mb-3">Hinzufügen</a>
                @endcan
                @if($customer->billingAddresses->count() > 0)
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>Postfach</th>
                                <th>Straße</th>
                                <th>PLZ</th>
                                <th>Ort</th>
                                <th>Aktionen</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($customer->billingAddresses as $address)
                                <tr>
                                    <td>{{ $address->name }}</td>
                                    <td>Postfach {{ $address->po_box }}</td>
                                    <td>{{ $address->street }}</td>
                                    <td>{{ $address->zip }}</td>
                                    <td>{{ $address->city }}</td>
                                    <td>
                                        @can('update', $address)
                                            <a href="{{ route('customers.addresses.billing.edit', ['id' => $customer->id, 'address_id' => $address->id]) }}">Ändern</a>
                                        @endcan
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="alert bg-info">Für diesen Kunden existieren keine Rechnungsadressen</div>
                @endif
            </div>
        @endcan
        @can('viewAny', \App\Models\ShippingAddress::class)
            <div class="col-lg-6 col-md-12">
                <h2>Lieferadressen</h2>
                @can('create', \App\Models\ShippingAddress::class)
                    <a href="{{ route('customers.addresses.shipping.create', ['id' => $customer->id]) }}"
                       class="btn btn-primary mb-3">Hinzufügen</a>
                @endcan
                @if($customer->shippingAddresses->count() > 0)
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>Straße</th>
                                <th>PLZ</th>
                                <th>Ort</th>
                                <th>Aktionen</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($customer->shippingAddresses as $address)
                                <tr>
                                    <td>{{ $address->name }}</td>
                                    <td>{{ $address->street }}</td>
                                    <td>{{ $address->zip }}</td>
                                    <td>{{ $address->city }}</td>
                                    <td>
                                        @can('update', $address)
                                            <a href="{{ route('customers.addresses.shipping.edit', ['id' => $customer->id, 'address_id' => $address->id]) }}">Ändern</a>
                                        @endcan
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="alert bg-info">Für diesen Kunden existieren keine Lieferadressen.</div>
                @endif
            </div>
        @endcan
    </div>
    @can('viewAny', \App\Models\CustomerContact::class)
        <h3>Kontakte</h3>
        @can('create', \App\Models\CustomerContact::class)
            <a href="{{ route('customers.contacts.create', ['id' => $customer->id]) }}" class="btn btn-primary mb-3">Hinzufügen</a>
        @endcan
        @if($customer->contacts->count() > 0)
            <div class="table-responsive">
                <table class="table">
                    <thead>
                    <tr>
                        <th>Betriebsstelle</th>
                        <th>Name</th>
                        <th>Telefon</th>
                        <th>E-Mail</th>
                        <th>Mobil</th>
                        <th>Position</th>
                        <th>Abteilung</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($customer->contacts as $contact)
                        <tr>
                            <td>
                                @if($contact->shippingAddress)
                                    {{ $contact->shippingAddress->name }}<br>
                                    {{ $contact->shippingAddress->street }}<br>
                                    {{ $contact->shippingAddress->zip }} {{ $contact->shippingAddress->city }}
                                @endif
                            </td>
                            <td>{{ $contact->name }}</td>
                            <td>{{ $contact->phone }}</td>
                            <td>{{ $contact->email }}</td>
                            <td>{{ $contact->mobile }}</td>
                            <td>{{ $contact->position }}</td>
                            <td>{{ $contact->division }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="alert bg-info">Für diesen Kunden existieren keine Kontakte.</div>
        @endif
    @endcan
    @can('viewAny', \App\Models\Ticket::class)
        @if(count($tickets) > 0)
            <h3>Offene Tickets</h3>
            <div class="row">
                @foreach($tickets as $ticket)
                    <div class="col-lg-3 col-md-6 col-sm-12">
                        <div class="card text-white bg-primary mb-3">
                            <div class="card-header">
                                <h3>
                                    <a href="{{ route('ticket.show', ['id' => $ticket->id]) }}" class="text-white">{{ $ticket->subject }}</a>
                                </h3>
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">{{ $ticket->contact_name }}</h5>
                                <p class="card-text">
                                    {{ $ticket->shipping_address_name }}
                                </p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    @endcan
@endsection
