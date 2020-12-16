@extends('layouts.app')

@section('title', 'Rechnungsadresse anlegen')

@section('content')
    <h1>Rechnungsadresse anlegen</h1>
    <form action="{{ route('customers.addresses.billing.store', ['id' => $id]) }}" method="post">
        @csrf
        <x-forms.text name="name" caption="Name" maxLength="128"/>
        <x-forms.text name="street" caption="Straße" maxLength="128"/>
        <x-forms.text name="po_box" caption="Postfach" maxLength="128"/>
        <div class="row">
            <div class="col-md-4 col-sm-12">
                <x-forms.text name="zip" caption="Postleitzahl" maxLength="5"/>
            </div>
            <div class="col-md-8 col-sm-12">
                <x-forms.text name="city" caption="Ort" maxLength="128"/>
            </div>
        </div>
        <x-forms.submit-button caption="Anlegen" />
    </form>
@endsection
