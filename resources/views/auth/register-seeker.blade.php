@extends('layouts.main')

@section('title', 'Register as a Seeker')

@section('content')
    <div class="container mx-auto py-8">
        <livewire:registration.registration-wizard user-type="seeker" />
    </div>
@endsection
