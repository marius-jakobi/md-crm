@extends('layouts.app')

@section('title', 'md-crm')

@section('content')
    <div class="jumbotron mt-3">
        <h1 class="display-4">Willkommen im md-crm!</h1>
        <p class="lead">Das Werkzeug für die Pflege Ihrer Kundenbeziehungen!</p>
        @guest
            <a href="{{ route('auth.login') }}" class="btn btn-primary btn-lg">Anmelden</a>
        @endguest
    </div>
@endsection
