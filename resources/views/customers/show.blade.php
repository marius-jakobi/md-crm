@extends('layouts.app')

@section('title', $customer->name)

@section('content')
    <h1>{{ $customer->name }}</h1>
    <p>erstellt: {{ $customer->created_at }}</p>
    <p>zuletzt geändert: {{ $customer->updated_at }}</p>
    <h2>Rechnungsadressen</h2>
    @can('create', \App\Models\BillingAddress::class)
        <a href="{{ route('customers.addresses.billing.create', ['id' => $customer->id]) }}" class="btn btn-primary mb-3">Hinzufügen</a>
    @endcan
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
    <h2>Lieferadressen</h2>
    @can('create', \App\Models\ShippingAddress::class)
        <a href="{{ route('customers.addresses.shipping.create', ['id' => $customer->id]) }}" class="btn btn-primary mb-3">Hinzufügen</a>
    @endcan
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
    <h3>Kontakte</h3>
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
@endsection
