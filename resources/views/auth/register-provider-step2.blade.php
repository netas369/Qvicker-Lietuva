@extends('layouts.main')

@section('content')

    <div class="flex items-center justify-center">
        <div class="w-full max-w-6xl px-4">
            <div class="flex items-center justify-center mt-10 mb-10">
                <ol class="flex items-center w-full text-sm font-medium text-center text-gray-500 sm:text-base">
                    <li class="flex md:w-full items-center text-primary-light sm:after:content-[''] after:w-full after:h-1 after:border-b after:border-primary-light after:border-1 after:hidden sm:after:inline-block after:mx-6 xl:after:mx-10">
                        <span class="flex items-center after:content-['/'] sm:after:hidden after:mx-2 after:text-gray-200">
                        <svg class="w-3.5 h-3.5 sm:w-4 sm:h-4 me-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z"/>
                        </svg>
                        Asmeninė <span class="hidden sm:inline-flex sm:ms-2">Info</span>
                        </span>
                    </li>
                    <li class="flex md:w-full items-center text-primary-light after:content-[''] after:w-full after:h-1 after:border-b after:border-gray-200 after:border-1 after:hidden sm:after:inline-block after:mx-6 xl:after:mx-10">
                        <span class="flex items-center after:content-['/'] sm:after:hidden after:mx-2 after:text-gray-200">
                        <span class="flex items-center justify-center w-3.5 h-3.5 sm:w-4 sm:h-4 text-white bg-primary-light rounded-full text-xs mr-2">2</span>
                        Jūsų <span class="hidden sm:inline-flex sm:ms-2">Įgūdžiai</span>
                        </span>
                    </li>
                    <li class="flex items-center">
                        <span class="me-2">3</span>
                        Patvirtinimas
                    </li>
                </ol>
            </div>
        </div>
    </div>


    <div class="font-[sans-serif] max-sm:px-4">
        <div class="mt-5 flex items-center justify-center">
            <div class="md:max-w-3xl w-full px-4 py-4 bg-white rounded-xl shadow-2xl">

                <form method="POST" action="{{ route('register.provider.processStep2') }}">
                    @csrf
                    <h3 class="mb-8 text-2xl leading-none font-bold text-primary">Jūsų Įgūdžiai</h3>
                    <div class="grid gap-4 mb-4 sm:grid-cols-2">

                    </div>
                    <button type="submit" class="text-white bg-primary-light hover:bg-primary transition focus:ring-4 focus:outline-none focus:ring-primary-dark font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                        Kitas: Patvirtinimas
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection
