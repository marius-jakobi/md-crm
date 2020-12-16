@extends('layouts.app')

@section('title', $customer->name)

@section('content')
    <h1>{{ $customer->name }}</h1>
    <p>erstellt: {{ $customer->created_at }}</p>
    <p>zuletzt geändert: {{ $customer->updated_at }}</p>
    <h2>Rechnungsadressen</h2>
    <table class="table">
        <thead>
        <tr>
            <td>Name</td>
            <td>Postfach</td>
            <td>Straße</td>
            <td>PLZ</td>
            <td>Ort</td>
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
        </tr>
        @endforeach
        </tbody>
    </table>
    <h2>Lieferadressen</h2>
    <table class="table">
        <thead>
        <tr>
            <td>Name</td>
            <td>Straße</td>
            <td>PLZ</td>
            <td>Ort</td>
        </tr>
        </thead>
        <tbody>
        @foreach($customer->shippingAddresses as $address)
            <tr>
                <td>{{ $address->name }}</td>
                <td>{{ $address->street }}</td>
                <td>{{ $address->zip }}</td>
                <td>{{ $address->city }}</td>
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
