@extends('layouts.app')

@section('title', 'Lieferadresse anlegen')

@section('content')
    <h1>Lieferadresse anlegen</h1>
    <form novalidate action="{{ route('customers.addresses.shipping.store', ['id' => $id]) }}" method="post">
        @csrf
        <x-forms.text name="name" caption="Name" maxLength="128"></x-forms.text>
        <x-forms.text name="street" caption="Straße" maxLength="128"></x-forms.text>
        <div class="row">
            <div class="col-md-4 col-sm-12">
                <x-forms.text name="zip" caption="Postleitzahl" maxLength="5"></x-forms.text>
            </div>
            <div class="col-md-8 col-sm-12">
                <x-forms.text name="city" caption="Ort" maxLength="128"></x-forms.text>
            </div>
        </div>
        <x-forms.submit-button caption="Anlegen"></x-forms.submit-button>
    </form>
@endsection
