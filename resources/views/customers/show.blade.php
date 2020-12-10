@extends('layouts.app')

@section('title', $customer->name)

@section('content')
    <h1>{{ $customer->name }}</h1>
    <p>erstellt: {{ $customer->created_at }}</p>
    <p>zuletzt geändert: {{ $customer->updated_at }}</p>
    <h2>Rechnungsadressen</h2>
    <ul>
    @foreach($customer->billingAddresses as $address)
        <li>
            {{ $address->name }},
            {{ $address->po_box ? 'Postfach ' . $address->po_box : $address->street }},
            {{ $address->zip . ' ' . $address->city }}
        </li>
    @endforeach
    </ul>
    <h2>Lieferadressen</h2>
    <ul>
    @foreach($customer->shippingAddresses as $address)
        <li>
            {{ $address->name }},
            {{ $address->po_box ? 'Postfach ' . $address->po_box : $address->street }},
            {{ $address->zip . ' ' . $address->city }}
        </li>
    @endforeach
    </ul>
@endsection
