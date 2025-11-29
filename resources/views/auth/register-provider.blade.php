@extends('layouts.main')

@section('content')
    <div class="container mx-auto py-8">
        <livewire:registration.registration-wizard user-type="provider" />
    </div>
@endsection
