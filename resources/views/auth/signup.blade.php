@extends('layouts.app')

@section('title', 'Registrieren')

@section('content')
    <div class="row">
        <div class="col-sm-12 col-md-6 offset-md-3 col-lg-4 offset-lg-4">
            <h1>Registrieren</h1>
            <form novalidate action="{{ route('auth.register') }}" method="post">
                @csrf
                <x-forms.email caption="E-Mail" maxLength="128"/>
                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <x-forms.text name="firstname" caption="Vorname" maxLength="128"/>
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <x-forms.text name="lastname" caption="Nachname" maxLength="128"/>
                    </div>
                </div>
                <x-forms.password caption="Passwort" maxLength="128"/>
                <x-forms.submit-button caption="Registrieren"/>
            </form>
        </div>
    </div>
@endsection
