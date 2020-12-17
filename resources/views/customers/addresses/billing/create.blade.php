@extends('layouts.app')

@section('title', 'Rechnungsadresse anlegen')

@section('content')
    <h1>Rechnungsadresse anlegen</h1>
    <x-forms.form action="{{ route('customers.addresses.billing.store', ['id' => $id]) }}" method="post">
        @csrf
        <x-forms.text name="name" caption="Name"></x-forms.text>
        <x-forms.text name="street" caption="Straße"></x-forms.text>
        <x-forms.text name="po_box" caption="Postfach"></x-forms.text>
        <div class="row">
            <div class="col-md-4 col-sm-12">
                <x-forms.text name="zip" caption="Postleitzahl" maxLength="5"></x-forms.text>
            </div>
            <div class="col-md-8 col-sm-12">
                <x-forms.text name="city" caption="Ort"></x-forms.text>
            </div>
        </div>
        <x-forms.submit-button caption="Anlegen"></x-forms.submit-button>
    </x-forms.form>
@endsection
