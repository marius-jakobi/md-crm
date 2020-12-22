@extends('layouts.app')

@section('title', 'Kontakt anlegen')

@section('content')
    <h1>Kontakt anlegen</h1>
    <x-forms.form action="{{ route('customers.contacts.store', ['id' => $id]) }}" method="post">
        @csrf
        <x-forms.text name="name" caption="Name"></x-forms.text>
        <x-forms.text name="phone" caption="Telefon"></x-forms.text>
        <x-forms.text name="email" caption="E-Mail-Adresse"></x-forms.text>
        <x-forms.text name="mobile" caption="Mobil"></x-forms.text>
        <x-forms.text name="position" caption="Position"></x-forms.text>
        <x-forms.text name="division" caption="Abteilung"></x-forms.text>
        <div class="form-group">
            @if($shippingAddresses->count() > 0)
                    <label>gehört zu Lieferadresse</label>
                    <select name="shipping_address_id" class="form-control">
                        <option value="">keine</option>
                        @foreach($shippingAddresses as $address)
                            <option value="{{ $address->id }}">{{ $address->name }}</option>
                        @endforeach
                    </select>

            @else
                <div class="alert alert-warning">
                    Es wurden keine Lieferadressen gefunden, denen dieser Kontakt zugeordnet werden könnte.
                </div>
            @endif
        </div>
        <a class="btn btn-secondary" href="{{ route('customer.show', ['id' => $id]) }}">Abbrechen</a>
        <x-forms.submit-button caption="Anlegen"></x-forms.submit-button>
    </x-forms.form>
@endsection
