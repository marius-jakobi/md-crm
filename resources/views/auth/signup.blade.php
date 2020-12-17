@extends('layouts.app')

@section('title', 'Registrieren')

@section('content')
    <div class="row">
        <div class="col-sm-12 col-md-6 offset-md-3 col-lg-4 offset-lg-4">
            <h1>Registrieren</h1>
            <x-forms.form action="{{ route('auth.register') }}" method="post">
                @csrf
                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <x-forms.text name="firstname" caption="Vorname"></x-forms.text>
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <x-forms.text name="lastname" caption="Nachname"></x-forms.text>
                    </div>
                </div>
                <x-forms.email caption="E-Mail"></x-forms.email>
                <x-forms.password caption="Passwort"></x-forms.password>
                <x-forms.submit-button caption="Registrieren"/>
            </x-forms.form>
        </div>
    </div>
@endsection
