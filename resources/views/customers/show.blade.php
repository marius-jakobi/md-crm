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
@endsection
