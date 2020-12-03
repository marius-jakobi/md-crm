@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <h1>Dashboard</h1>
    @if(Auth::user()->roles->count() > 0)
    <h2>Rollen</h2>
    <ul>
        @foreach(Auth::user()->roles as $role)
        <li>{{ $role->name }}</li>
        @endforeach
    </ul>
    @endif
@endsection
