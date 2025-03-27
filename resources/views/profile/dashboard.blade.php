@extends('layouts.main')

@section('content')


    <x-profile-nav-tabs />

            <!-- Right side - Notifications -->
    <div class="flex justify-center mt-6">
        <div class="w-full md:w-1/3 mt-6 md:mt-0">
            @livewire('notifications-component')
        </div>
    </div>


@endsection
