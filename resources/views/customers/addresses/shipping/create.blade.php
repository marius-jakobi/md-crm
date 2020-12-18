@extends('layouts.app')

@section('title', 'Lieferadresse anlegen')

@section('content')
    <h1>Lieferadresse anlegen</h1>
    <a href="{{ route('customer.show', ['id' => $id]) }}">Zum Kunden</a>
    <x-forms.form novalidate action="{{ route('customers.addresses.shipping.store', ['id' => $id]) }}" method="post">
        @csrf
        <x-forms.text name="name" caption="Name"></x-forms.text>
        <x-forms.text name="street" caption="Straße"></x-forms.text>
        <div class="row">
            <div class="col-md-4 col-sm-12">
                <x-forms.text name="zip" caption="Postleitzahl" maxlength="5"></x-forms.text>
            </div>
            <div class="col-md-8 col-sm-12">
                <x-forms.text name="city" caption="Ort"></x-forms.text>
            </div>
        </div>
        <a class="btn btn-secondary" href="{{ route('customer.show', ['id' => $id]) }}">Abbrechen</a>
        <x-forms.submit-button caption="Anlegen"></x-forms.submit-button>
    </x-forms.form>
@endsection
