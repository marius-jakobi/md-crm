@extends('layouts.app')

@section('title', 'Kundenliste')

@section('content')
    <h1>Kundenliste</h1>
    <table class="table">
        <thead>
        <tr>
            <th>Name</th>
            <th>erstellt</th>
        </tr>
        </thead>
        <tbody>
        @foreach($customers as $customer)
            <tr>
                <td>
                    @can('view', $customer)
                    <a href="{{ route('customer.show', ['id' => $customer->id]) }}">{{ $customer->name }}</a>
                    @endcan
                    @cannot('view', $customer)
                    {{ $customer->name }}
                    @endcannot
                </td>
                <td>{{ $customer->created_at }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{ $customers->links() }}
@endsection
