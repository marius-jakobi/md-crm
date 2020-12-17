@extends('layouts.app')

@section('title', 'Rechnungsadresse ändern')

@section('content')
    <h1>Rechnungsadresse ändern</h1>
    <x-forms.form action="{{ route('customers.addresses.billing.update', ['id' => $address->customer->id, 'address_id' => $address->id]) }}" method="post">
        @csrf
        @method('put')
        <x-forms.text name="name" caption="Name" value="{{ $address->name }}" required></x-forms.text>
        <x-forms.text name="street" caption="Straße" value="{{ $address->street }}"></x-forms.text>
        <x-forms.text name="po_box" caption="Postfach" value="{{ $address->po_box }}"></x-forms.text>
        <div class="row">
            <div class="col-md-4 col-sm-12">
                <x-forms.text name="zip" caption="Postleitzahl" maxlength="5" value="{{ $address->zip }}" required></x-forms.text>
            </div>
            <div class="col-md-8 col-sm-12">
                <x-forms.text name="city" caption="Ort" value="{{ $address->city }}" required></x-forms.text>
            </div>
        </div>
        <x-forms.submit-button caption="Speichern"></x-forms.submit-button>
    </x-forms.form>
@endsection
