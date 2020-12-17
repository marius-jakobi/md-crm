@extends('layouts.app')

@section('title', 'Anmelden')

@section('content')
    <div class="row">
        <div class="col-sm-12 col-md-6 offset-md-3 col-lg-4 offset-lg-4">
            <h1>Anmelden</h1>
            <x-forms.form action="{{ route('auth.authenticate') }}" method="post">
                @csrf
                <x-forms.email caption="E-Mail" maxLength="128"/>
                <x-forms.password caption="Passwort" maxLength="128"/>
                <x-forms.checkbox caption="Angemeldet bleiben" name="remember"/>
                <x-forms.submit-button caption="Anmelden"/>
            </x-forms.form>
        </div>
    </div>
@endsection
