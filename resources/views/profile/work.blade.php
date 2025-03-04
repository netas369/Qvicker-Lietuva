@extends('layouts.main')

@section('content')

    <x-profile-nav-tabs />

    <div class="w-full max-w-4xl mx-auto p-4">
    <livewire:provider-work-categories />
    </div>

@endsection
