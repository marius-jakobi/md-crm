@extends('layouts.app')

@section('title', 'Ticket erstellen')

@section('content')
    <h1>Ticket erstellen</h1>
    <p>Kunde: {{ $customer->name }}</p>
    <x-forms.form action="{{ route('ticket.store', ['id' => $customer->id]) }}" method="post">
        @csrf
        <div class="row">
            <div class="col-lg-6 col-sm-12">
                <div class="form-group">
                    <label>Betriebsstelle</label>
                    <select name="shipping_address_id" class="form-control">
                        <option value=""></option>
                        @foreach($customer->shippingAddresses as $address)
                            <option value="{{ $address->id }}">{{ $address->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>Ticket-Empfänger</label>
                    <select name="receiver_id" class="form-control">
                        <option value=""></option>
                        @foreach($receivers as $receiver)
                            <option value="{{ $receiver->id }}" @if(old('receiver_id') == $receiver->id) selected="selected" @endif>{{ $receiver->fullName() }}</option>
                        @endforeach
                    </select>
                    @error('receiver_id')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <x-forms.text name="subject" caption="Betreff"></x-forms.text>
            </div>
            <div class="col-lg-6 col-sm-12">
                <x-forms.text name="contact_name" caption="Ansprechpartner"></x-forms.text>
                <x-forms.text name="contact_phone" caption="Telefon"></x-forms.text>
                <x-forms.text name="contact_mail" caption="E-Mail"></x-forms.text>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <x-forms.textarea name="text" caption="Text" rows="10"></x-forms.textarea>
                <x-forms.submit-button caption="Ticket erstellen"></x-forms.submit-button>
            </div>
        </div>
    </x-forms.form>
    {{ $errors }}
@endsection
