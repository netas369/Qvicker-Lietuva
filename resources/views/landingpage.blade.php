@extends('layouts.main')

@section('title', 'MyAppLietuva')

@section('content')
    <!-- MAIN CONTENT DIV -->
    <div class="px-4 sm:px-6 md:px-10 lg:px-20 xl:px-40 2xl:px-60 lg:mt-24 md:mt-14">
        <div class="text-center mt-10">
            <h1 class="text-3xl lg:text-5xl font-bold text-primary-light font-sans leading-7">Rasti profesionalią pagalbą - dabar lengva</h1>
            <p class="mt-10 text-lg text-primary-light font-sans">Susisiekite tiesiogiai su patikimais paslaugų teikėjais visiems namų poreikiams, nuo žolės
        pjovimo iki dažymo ir dar daugiau.</p>
        </div>
    <div>

    <!-- Search Bar -->
        <form class="flex items-center max-w-lg mx-auto mt-10">
            <label for="voice-search" class="sr-only">Search</label>
            <div class="relative w-full">
                <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                    <svg class="w-6 h-6 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7a2 2 0 0 1 2-2h5l2 2h7a2 2 0 0 1 2 2v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V7Z"/>
                    </svg>
                </div>
                <input type="text" id="voice-search" class="bg-gray-50 border border-gray-300 text-gray-900 text-md rounded-lg focus:ring-primary-verylight focus:border-primary-light block w-full ps-10 p-2.5  ml-2" placeholder="Ieskoti paslaugos..." required />
                <button type="button" class="absolute inset-y-0 end-0 flex items-center pe-3">
                    <svg class="w-5 h-6 text-primary dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                    </svg>
                </button>
            </div>
{{--            <button type="submit" class="inline-flex items-center py-2.5 px-3 ms-2 text-sm font-medium text-white bg-blue-700 rounded-lg border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">--}}
{{--                <svg class="w-4 h-4 me-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">--}}
{{--                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>--}}
{{--                </svg>Search--}}
{{--            </button>--}}
        </form>

        <!-- Skiriamoji juosta -->
        <div class="flex justify-center items-center space-x-2 mx-auto max-w-md my-8 mt-12">
            <hr class="w-16 h-1 bg-primary-light border-0 rounded md:my-12 opacity-50">
            <hr class="w-16 h-1 bg-primary-light border-0 rounded md:my-12 opacity-50">
            <hr class="w-16 h-1 bg-primary-light border-0 rounded md:my-12 opacity-50">
        </div>

        <!-- Populiarios kategorijos -->
        <div class="px-4 sm:px-6 md:px-10 lg:px-20 xl:px-40 2xl:px-60">
            <div class="text-center mt-10">
                <h1 class="text-3xl lg:text-4xl font-bold text-primary-light font-sans leading-7">Populiarios Kategorijos</h1>
            </div>
        </div>

        <!-- Karusele kategoriju -->
        <div class="mb-4 border-b border-gray-200 justify-items-center mt-4">
            <ul class="flex flex-wrap -mb-px text-sm font-medium text-center" id="default-styled-tab" data-tabs-toggle="#default-styled-tab-content" data-tabs-active-classes="text-primary-light hover:text-primary-light border-primary-light" data-tabs-inactive-classes="text-gray-500 hover:text-gray-600 border-gray-100 hover:border-gray-300" role="tablist">
{{--                <li class="me-2" role="presentation">--}}
{{--                    <button class="inline-block p-4 border-b-2 rounded-t-lg" id="profile-styled-tab" data-tabs-target="#styled-profile" type="button" role="tab" aria-controls="profile" aria-selected="false">--}}
{{--                        <svg xmlns="http://www.w3.org/2000/svg" data-name="ICON Black" viewBox="0 0 32 40" x="0px" y="0px"><title>Cleaning service</title><path d="M29.5,20.606V18.759a1.5,1.5,0,0,0-1.5-1.5H22.873V9.27a2,2,0,0,0-2-2h-.745a2,2,0,0,0-2,2v7.989H13a1.5,1.5,0,0,0-1.5,1.5v1.847a1.5,1.5,0,0,0,.932,1.387L11.9,28.962a.509.509,0,0,0,.132.378.5.5,0,0,0,.367.16H28.6a.5.5,0,0,0,.367-.16.509.509,0,0,0,.132-.378l-.533-6.969A1.5,1.5,0,0,0,29.5,20.606ZM19.13,9.27a1,1,0,0,1,1-1h.745a1,1,0,0,1,1,1v7.989H19.13ZM12.5,18.759a.5.5,0,0,1,.5-.5H28a.5.5,0,0,1,.5.5v1.847a.5.5,0,0,1-.5.5H13a.5.5,0,0,1-.5-.5Zm.439,9.741.488-6.394h2.735l-.133,2.986a.5.5,0,0,0,.477.522h.022a.5.5,0,0,0,.5-.478l.135-3.031H20V23.36a.5.5,0,0,0,1,0V22.106h2.836l.135,3.031a.5.5,0,0,0,.5.478h.022a.5.5,0,0,0,.477-.522l-.133-2.986h2.735l.489,6.394ZM5,19.069l2.946-3.911a1.509,1.509,0,0,1,1.2-.6h4.1a.5.5,0,0,1,.5.5V16a.5.5,0,0,0,1,0v-.94a1.5,1.5,0,0,0-1.437-1.494V11.973a1.5,1.5,0,0,0,1.438-1.494V8.458a1.5,1.5,0,0,0-1.5-1.5H8.376A1.5,1.5,0,0,0,6.929,8.083H5.406a1.386,1.386,0,0,0,0,2.771H6.929a1.482,1.482,0,0,0,.306.587L5.6,13.772a.5.5,0,0,0,.122.7.491.491,0,0,0,.287.091.5.5,0,0,0,.409-.212l1.683-2.4a1.487,1.487,0,0,0,.277.028h2.1V13.56H9.147a2.515,2.515,0,0,0-2,1L4.2,18.468a3.52,3.52,0,0,0-.7,2.105V28A1.5,1.5,0,0,0,5,29.5h5.469a.5.5,0,1,0,0-1H5a.5.5,0,0,1-.5-.5V20.573A2.519,2.519,0,0,1,5,19.069ZM7.876,8.458a.5.5,0,0,1,.5-.5h4.875a.5.5,0,0,1,.5.5v2.021a.5.5,0,0,1-.5.5H8.376a.5.5,0,0,1-.5-.5V8.458ZM5.021,9.469a.385.385,0,0,1,.385-.386h1.47v.771H5.406A.385.385,0,0,1,5.021,9.469Zm6.458,2.51h.834V13.56h-.834Z"/></svg>--}}
{{--                        <span class="block mt-2">Valymas</span>--}}
{{--                    </button>--}}
{{--                </li>--}}

{{--                <li class="me-2" role="presentation">--}}
{{--                    <button class="inline-block p-4 border-b-2 rounded-t-lg" id="profile-styled-tab" data-tabs-target="#styled-kuryba" type="button" role="tab" aria-controls="Kuryba" aria-selected="false">--}}
{{--                        <svg xmlns="http://www.w3.org/2000/svg" data-name="ICON Black" viewBox="0 0 32 40" x="0px" y="0px"><title>Cleaning service</title><path d="M29.5,20.606V18.759a1.5,1.5,0,0,0-1.5-1.5H22.873V9.27a2,2,0,0,0-2-2h-.745a2,2,0,0,0-2,2v7.989H13a1.5,1.5,0,0,0-1.5,1.5v1.847a1.5,1.5,0,0,0,.932,1.387L11.9,28.962a.509.509,0,0,0,.132.378.5.5,0,0,0,.367.16H28.6a.5.5,0,0,0,.367-.16.509.509,0,0,0,.132-.378l-.533-6.969A1.5,1.5,0,0,0,29.5,20.606ZM19.13,9.27a1,1,0,0,1,1-1h.745a1,1,0,0,1,1,1v7.989H19.13ZM12.5,18.759a.5.5,0,0,1,.5-.5H28a.5.5,0,0,1,.5.5v1.847a.5.5,0,0,1-.5.5H13a.5.5,0,0,1-.5-.5Zm.439,9.741.488-6.394h2.735l-.133,2.986a.5.5,0,0,0,.477.522h.022a.5.5,0,0,0,.5-.478l.135-3.031H20V23.36a.5.5,0,0,0,1,0V22.106h2.836l.135,3.031a.5.5,0,0,0,.5.478h.022a.5.5,0,0,0,.477-.522l-.133-2.986h2.735l.489,6.394ZM5,19.069l2.946-3.911a1.509,1.509,0,0,1,1.2-.6h4.1a.5.5,0,0,1,.5.5V16a.5.5,0,0,0,1,0v-.94a1.5,1.5,0,0,0-1.437-1.494V11.973a1.5,1.5,0,0,0,1.438-1.494V8.458a1.5,1.5,0,0,0-1.5-1.5H8.376A1.5,1.5,0,0,0,6.929,8.083H5.406a1.386,1.386,0,0,0,0,2.771H6.929a1.482,1.482,0,0,0,.306.587L5.6,13.772a.5.5,0,0,0,.122.7.491.491,0,0,0,.287.091.5.5,0,0,0,.409-.212l1.683-2.4a1.487,1.487,0,0,0,.277.028h2.1V13.56H9.147a2.515,2.515,0,0,0-2,1L4.2,18.468a3.52,3.52,0,0,0-.7,2.105V28A1.5,1.5,0,0,0,5,29.5h5.469a.5.5,0,1,0,0-1H5a.5.5,0,0,1-.5-.5V20.573A2.519,2.519,0,0,1,5,19.069ZM7.876,8.458a.5.5,0,0,1,.5-.5h4.875a.5.5,0,0,1,.5.5v2.021a.5.5,0,0,1-.5.5H8.376a.5.5,0,0,1-.5-.5V8.458ZM5.021,9.469a.385.385,0,0,1,.385-.386h1.47v.771H5.406A.385.385,0,0,1,5.021,9.469Zm6.458,2.51h.834V13.56h-.834Z"/></svg>--}}
{{--                        <span class="block mt-2">Kūryba</span>--}}
{{--                    </button>--}}
{{--                </li>--}}
                <ul class="flex flex-wrap -mb-px text-sm font-medium text-center" id="default-styled-tab" data-tabs-toggle="#default-styled-tab-content" data-tabs-active-classes="text-primary hover:text-primary" data-tabs-inactive-classes="text-gray-500 hover:text-gray-600 border-gray-100 hover:border-gray-300" role="tablist">
                    <li class="me-2" role="presentation">
                        <button class="inline-block p-4 border-b-2 rounded-t-lg" id="profile-styled-tab" data-tabs-target="#styled-profile" type="button" role="tab" aria-controls="profile" aria-selected="false">
                            <svg xmlns="http://www.w3.org/2000/svg" data-name="ICON Black" viewBox="0 0 32 40" class="w-16 h-16 mx-auto">
                                <path d="M29.5,20.606V18.759a1.5,1.5,0,0,0-1.5-1.5H22.873V9.27a2,2,0,0,0-2-2h-.745a2,2,0,0,0-2,2v7.989H13a1.5,1.5,0,0,0-1.5,1.5v1.847a1.5,1.5,0,0,0,.932,1.387L11.9,28.962a.509.509,0,0,0,.132.378.5.5,0,0,0,.367.16H28.6a.5.5,0,0,0,.367-.16.509.509,0,0,0,.132-.378l-.533-6.969A1.5,1.5,0,0,0,29.5,20.606ZM19.13,9.27a1,1,0,0,1,1-1h.745a1,1,0,0,1,1,1v7.989H19.13ZM12.5,18.759a.5.5,0,0,1,.5-.5H28a.5.5,0,0,1,.5.5v1.847a.5.5,0,0,1-.5.5H13a.5.5,0,0,1-.5-.5Zm.439,9.741.488-6.394h2.735l-.133,2.986a.5.5,0,0,0,.477.522h.022a.5.5,0,0,0,.5-.478l.135-3.031H20V23.36a.5.5,0,0,0,1,0V22.106h2.836l.135,3.031a.5.5,0,0,0,.5.478h.022a.5.5,0,0,0,.477-.522l-.133-2.986h2.735l.489,6.394ZM5,19.069l2.946-3.911a1.509,1.509,0,0,1,1.2-.6h4.1a.5.5,0,0,1,.5.5V16a.5.5,0,0,0,1,0v-.94a1.5,1.5,0,0,0-1.437-1.494V11.973a1.5,1.5,0,0,0,1.438-1.494V8.458a1.5,1.5,0,0,0-1.5-1.5H8.376A1.5,1.5,0,0,0,6.929,8.083H5.406a1.386,1.386,0,0,0,0,2.771H6.929a1.482,1.482,0,0,0,.306.587L5.6,13.772a.5.5,0,0,0,.122.7.491.491,0,0,0,.287.091.5.5,0,0,0,.409-.212l1.683-2.4a1.487,1.487,0,0,0,.277.028h2.1V13.56H9.147a2.515,2.515,0,0,0-2,1L4.2,18.468a3.52,3.52,0,0,0-.7,2.105V28A1.5,1.5,0,0,0,5,29.5h5.469a.5.5,0,1,0,0-1H5a.5.5,0,0,1-.5-.5V20.573A2.519,2.519,0,0,1,5,19.069ZM7.876,8.458a.5.5,0,0,1,.5-.5h4.875a.5.5,0,0,1,.5.5v2.021a.5.5,0,0,1-.5.5H8.376a.5.5,0,0,1-.5-.5V8.458ZM5.021,9.469a.385.385,0,0,1,.385-.386h1.47v.771H5.406A.385.385,0,0,1,5.021,9.469Zm6.458,2.51h.834V13.56h-.834Z" />
                            </svg>
                            <span class="block mt-2 text-primary">Valymas</span>
                        </button>
                    </li>
                    <li class="me-2" role="presentation">
                        <button class="inline-block p-4 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300" id="dashboard-styled-tab" data-tabs-target="#styled-dashboard" type="button" role="tab" aria-controls="dashboard" aria-selected="false">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 28 35" x="0px" y="0px" class="w-16 h-16 mx-auto"><title>photo</title><g data-name="Layer 2"><path d="M25.814,11.637a1.476,1.476,0,0,0-1.514.1l-3.8,2.709V12.937A2.439,2.439,0,0,0,18.063,10.5h-.269a4.489,4.489,0,1,0-6.957-5.2,3.991,3.991,0,1,0-5.955,5.2H3.937A2.439,2.439,0,0,0,1.5,12.937V23.063A2.439,2.439,0,0,0,3.937,25.5H18.063A2.439,2.439,0,0,0,20.5,23.063V21.525l1.132.807a.489.489,0,0,0,.183.131L24.3,24.235a1.446,1.446,0,0,0,.839.265,1.47,1.47,0,0,0,.675-.163,1.2,1.2,0,0,0,.686-1.074V12.711A1.2,1.2,0,0,0,25.814,11.637ZM15,3.5A3.5,3.5,0,1,1,11.5,7,3.5,3.5,0,0,1,15,3.5Zm-2.794,7H10.118A4.011,4.011,0,0,0,11.1,9.207,4.5,4.5,0,0,0,12.206,10.5ZM4.5,7.5a3,3,0,1,1,3,3A3,3,0,0,1,4.5,7.5Zm15,15.563A1.439,1.439,0,0,1,18.063,24.5H3.937A1.439,1.439,0,0,1,2.5,23.063V12.937A1.439,1.439,0,0,1,3.937,11.5H18.063A1.439,1.439,0,0,1,19.5,12.937Zm1-7.386,1-.713V21.01l-1-.714Zm5,7.586a.231.231,0,0,1-.143.185.471.471,0,0,1-.476-.027l-2.381-1.7V14.251l2.381-1.7a.471.471,0,0,1,.476-.027.231.231,0,0,1,.143.185Z"/><path d="M7.5,5.833A1.667,1.667,0,1,0,9.167,7.5,1.669,1.669,0,0,0,7.5,5.833Zm0,2.334A.667.667,0,1,1,8.167,7.5.667.667,0,0,1,7.5,8.167Z"/><path d="M15,9.214A2.214,2.214,0,1,0,12.786,7,2.216,2.216,0,0,0,15,9.214Zm0-3.428A1.214,1.214,0,1,1,13.786,7,1.216,1.216,0,0,1,15,5.786Z"/><path d="M13.279,18.5H5.721A1.223,1.223,0,0,0,4.5,19.721v1.558A1.223,1.223,0,0,0,5.721,22.5h7.558A1.223,1.223,0,0,0,14.5,21.279V19.721A1.223,1.223,0,0,0,13.279,18.5Zm.221,2.779a.221.221,0,0,1-.221.221H5.721a.221.221,0,0,1-.221-.221V19.721a.221.221,0,0,1,.221-.221h7.558a.221.221,0,0,1,.221.221Z"/><path d="M16.572,13.5H15.428a.929.929,0,0,0-.928.928v1.144a.929.929,0,0,0,.928.928h1.144a.929.929,0,0,0,.928-.928V14.428A.929.929,0,0,0,16.572,13.5Zm-.072,2h-1v-1h1Z"/><path d="M12,16.5A1.5,1.5,0,1,0,10.5,15,1.5,1.5,0,0,0,12,16.5Zm0-2a.5.5,0,1,1-.5.5A.5.5,0,0,1,12,14.5Z"/></g><text x="0" y="43" fill="#000000" font-size="5px" font-weight="bold" font-family="'Helvetica Neue', Helvetica, Arial-Unicode, Arial, Sans-serif">Created by Ilham Fitrotul Hayat</text><text x="0" y="48" fill="#000000" font-size="5px" font-weight="bold" font-family="'Helvetica Neue', Helvetica, Arial-Unicode, Arial, Sans-serif">from the Noun Project</text></svg>

                            <span class="block mt-2 text-primary">Kūryba</span>
                        </button>
                    </li>
                    <li class="me-2" role="presentation">
                        <button class="inline-block p-4 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300" id="settings-styled-tab" data-tabs-target="#styled-settings" type="button" role="tab" aria-controls="settings" aria-selected="false">Settings</button>
                    </li>
                    <li role="presentation">
                        <button class="inline-block p-4 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300" id="contacts-styled-tab" data-tabs-target="#styled-contacts" type="button" role="tab" aria-controls="contacts" aria-selected="false">Contacts</button>
                    </li>
                </ul>
            </ul>
        </div>

        <div id="default-styled-tab-content">
            <div class="hidden p-4 rounded-lg bg-gray-50" id="styled-profile" role="tabpanel" aria-labelledby="profile-tab">
                <p class="text-sm text-gray-500">This is some placeholder content the <strong class="font-medium text-gray-800 dark:text-white">Profile tab's associated content</strong>. Clicking another tab will toggle the visibility of this one for the next. The tab JavaScript swaps classes to control the content visibility and styling.</p>
            </div>
            <div class="hidden p-4 rounded-lg bg-gray-50" id="styled-dashboard" role="tabpanel" aria-labelledby="dashboard-tab">
                <p class="text-sm text-gray-500">This is some placeholder content the <strong class="font-medium text-gray-800 dark:text-white">Dashboard tab's associated content</strong>. Clicking another tab will toggle the visibility of this one for the next. The tab JavaScript swaps classes to control the content visibility and styling.</p>
            </div>
            <div class="hidden p-4 rounded-lg bg-gray-50" id="styled-settings" role="tabpanel" aria-labelledby="settings-tab">
                <p class="text-sm text-gray-500">This is some placeholder content the <strong class="font-medium text-gray-800 dark:text-white">Settings tab's associated content</strong>. Clicking another tab will toggle the visibility of this one for the next. The tab JavaScript swaps classes to control the content visibility and styling.</p>
            </div>
            <div class="hidden p-4 rounded-lg bg-gray-50" id="styled-contacts" role="tabpanel" aria-labelledby="contacts-tab">
                <p class="text-sm text-gray-500 ">This is some placeholder content the <strong class="font-medium text-gray-800 dark:text-white">Contacts tab's associated content</strong>. Clicking another tab will toggle the visibility of this one for the next. The tab JavaScript swaps classes to control the content visibility and styling.</p>
            </div>
        </div>



        <!-- Kategoriju Sarasas -->
        <section class="py-8 antialiased md:py-12">
            <div class="mx-auto max-w-screen-xl px-4 2xl:px-0">
                <div class="mb-4 flex items-center justify-between gap-4 md:mb-8">
                    <h2 class="text-xl font-semibold text-primary-dark sm:text-2xl"></h2>

                    <a href="#" title="" class="flex items-center text-base font-medium text-primary-700 hover:underline dark:text-primary-500">
                        Visos Kategorijos
                        <svg class="ms-1 h-5 w-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 12H5m14 0-4 4m4-4-4-4" />
                        </svg>
                    </a>
                </div>

                <div class="grid gap-4 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4">
                    <a href="#" class="flex items-center justify-between rounded-lg border border-gray-200 bg-primary-backgroundlight px-4 py-2 hover:bg-primary-backgrounddark mb-2">
                        <div class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg"
                                 fill="none"
                                 viewBox="0 0 24 24"
                                 stroke-width="1.5"
                                 stroke="currentColor"
                                 class="h-6 w-6 text-gray-900 mr-2">
                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                            </svg>
                            <span class="text-sm font-medium text-gray-900">Namų priežiūra ir valymas</span>
                        </div>
                        <svg xmlns="http://www.w3.org/2000/svg"
                             fill="none"
                             viewBox="0 0 24 24"
                             stroke-width="1.5"
                             stroke="currentColor"
                             class="h-4 w-4 text-gray-500">
                            <path stroke-linecap="round"
                                  stroke-linejoin="round"
                                  d="M9 5l7 7-7 7" />
                        </svg>
                    </a>

                    <a href="#" class="flex items-center justify-between rounded-lg border border-gray-200 bg-primary-backgroundlight px-4 py-2 hover:bg-primary-backgrounddark mb-2">
                        <div class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg"
                                 fill="none"
                                 viewBox="0 0 24 24"
                                 stroke-width="1.5"
                                 stroke="currentColor"
                                 class="h-6 w-6 text-gray-900 mr-2">
                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      d="M6.827 6.175A2.31 2.31 0 0 1 5.186 7.23c-.38.054-.757.112-1.134.175C2.999 7.58 2.25 8.507 2.25 9.574V18a2.25 2.25 0 0 0 2.25 2.25h15A2.25 2.25 0 0 0 21.75 18V9.574c0-1.067-.75-1.994-1.802-2.169a47.865 47.865 0 0 0-1.134-.175 2.31 2.31 0 0 1-1.64-1.055l-.822-1.316a2.192 2.192 0 0 0-1.736-1.039 48.774 48.774 0 0 0-5.232 0 2.192 2.192 0 0 0-1.736 1.039l-.821 1.316Z" />
                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      d="M16.5 12.75a4.5 4.5 0 1 1-9 0 4.5 4.5 0 0 1 9 0ZM18.75 10.5h.008v.008h-.008V10.5Z" />
                            </svg>
                            <span class="text-sm font-medium text-gray-900">Kūrybos ir medijos paslaugos</span>
                        </div>
                        <svg xmlns="http://www.w3.org/2000/svg"
                             fill="none"
                             viewBox="0 0 24 24"
                             stroke-width="1.5"
                             stroke="currentColor"
                             class="h-4 w-4 text-gray-500">
                            <path stroke-linecap="round"
                                  stroke-linejoin="round"
                                  d="M9 5l7 7-7 7" />
                        </svg>
                    </a>

                    <a href="#" class="flex items-center justify-between rounded-lg border border-gray-200 bg-primary-backgroundlight px-4 py-2 hover:bg-primary-backgrounddark mb-2">
                        <div class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg"
                                 fill="none"
                                 viewBox="0 0 24 24"
                                 stroke-width="1.5"
                                 stroke="currentColor"
                                 class="h-6 w-6 text-gray-900 mr-2">
                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      d="M11.42 15.17 17.25 21A2.652 2.652 0 0 0 21 17.25l-5.877-5.877M11.42 15.17l2.496-3.03c.317-.384.74-.626 1.208-.766M11.42 15.17l-4.655 5.653a2.548 2.548 0 1 1-3.586-3.586l6.837-5.63m5.108-.233c.55-.164 1.163-.188 1.743-.14a4.5 4.5 0 0 0 4.486-6.336l-3.276 3.277a3.004 3.004 0 0 1-2.25-2.25l3.276-3.276a4.5 4.5 0 0 0-6.336 4.486c.091 1.076-.071 2.264-.904 2.95l-.102.085m-1.745 1.437L5.909 7.5H4.5L2.25 3.75l1.5-1.5L7.5 4.5v1.409l4.26 4.26m-1.745 1.437 1.745-1.437m6.615 8.206L15.75 15.75M4.867 19.125h.008v.008h-.008v-.008Z" />
                            </svg>
                            <span class="text-sm font-medium text-gray-900">Meistrų ir remonto paslaugos</span>
                        </div>
                        <svg xmlns="http://www.w3.org/2000/svg"
                             fill="none"
                             viewBox="0 0 24 24"
                             stroke-width="1.5"
                             stroke="currentColor"
                             class="h-4 w-4 text-gray-500">
                            <path stroke-linecap="round"
                                  stroke-linejoin="round"
                                  d="M9 5l7 7-7 7" />
                        </svg>
                    </a>

                    <a href="#" class="flex items-center justify-between rounded-lg border border-gray-200 bg-primary-backgroundlight px-4 py-2 hover:bg-primary-backgrounddark mb-2">
                        <div class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg"
                                 fill="none"
                                 viewBox="0 0 24 24"
                                 stroke-width="1.5"
                                 stroke="currentColor"
                                 class="h-6 w-6 text-gray-900 mr-2">
                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      d="M6 12 3.269 3.125A59.769 59.769 0 0 1 21.485 12 59.768 59.768 0 0 1 3.27 20.875L5.999 12Zm0 0h7.5" />
                            </svg>
                            <span class="text-sm font-medium text-gray-900">Perkraustymas ir transportas</span>
                        </div>
                        <svg xmlns="http://www.w3.org/2000/svg"
                             fill="none"
                             viewBox="0 0 24 24"
                             stroke-width="1.5"
                             stroke="currentColor"
                             class="h-4 w-4 text-gray-500">
                            <path stroke-linecap="round"
                                  stroke-linejoin="round"
                                  d="M9 5l7 7-7 7" />
                        </svg>
                    </a>

                    <a href="#" class="flex items-center justify-between rounded-lg border border-gray-200 bg-primary-backgroundlight px-4 py-2 hover:bg-primary-backgrounddark md:mt-8 mb-2">
                        <div class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg"
                                 fill="none"
                                 viewBox="0 0 24 24"
                                 stroke-width="1.5"
                                 stroke="currentColor"
                                 class="h-6 w-6 text-gray-900 mr-2">
                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                            </svg>
                            <span class="text-sm font-medium text-gray-900">Namų priežiūra ir valymas</span>
                        </div>
                        <svg xmlns="http://www.w3.org/2000/svg"
                             fill="none"
                             viewBox="0 0 24 24"
                             stroke-width="1.5"
                             stroke="currentColor"
                             class="h-4 w-4 text-gray-500">
                            <path stroke-linecap="round"
                                  stroke-linejoin="round"
                                  d="M9 5l7 7-7 7" />
                        </svg>
                    </a>

                    <a href="#" class="flex items-center justify-between rounded-lg border border-gray-200 bg-primary-backgroundlight px-4 py-2 hover:bg-primary-backgrounddark md:mt-8 mb-2">
                        <div class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg"
                                 fill="none"
                                 viewBox="0 0 24 24"
                                 stroke-width="1.5"
                                 stroke="currentColor"
                                 class="h-6 w-6 text-gray-900 mr-2">
                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      d="M6.827 6.175A2.31 2.31 0 0 1 5.186 7.23c-.38.054-.757.112-1.134.175C2.999 7.58 2.25 8.507 2.25 9.574V18a2.25 2.25 0 0 0 2.25 2.25h15A2.25 2.25 0 0 0 21.75 18V9.574c0-1.067-.75-1.994-1.802-2.169a47.865 47.865 0 0 0-1.134-.175 2.31 2.31 0 0 1-1.64-1.055l-.822-1.316a2.192 2.192 0 0 0-1.736-1.039 48.774 48.774 0 0 0-5.232 0 2.192 2.192 0 0 0-1.736 1.039l-.821 1.316Z" />
                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      d="M16.5 12.75a4.5 4.5 0 1 1-9 0 4.5 4.5 0 0 1 9 0ZM18.75 10.5h.008v.008h-.008V10.5Z" />
                            </svg>
                            <span class="text-sm font-medium text-gray-900">Kūrybos ir medijos paslaugos</span>
                        </div>
                        <svg xmlns="http://www.w3.org/2000/svg"
                             fill="none"
                             viewBox="0 0 24 24"
                             stroke-width="1.5"
                             stroke="currentColor"
                             class="h-4 w-4 text-gray-500">
                            <path stroke-linecap="round"
                                  stroke-linejoin="round"
                                  d="M9 5l7 7-7 7" />
                        </svg>
                    </a>

                    <a href="#" class="flex items-center justify-between rounded-lg border border-gray-200 bg-primary-backgroundlight px-4 py-2 hover:bg-primary-backgrounddark md:mt-8 mb-2">
                        <div class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg"
                                 fill="none"
                                 viewBox="0 0 24 24"
                                 stroke-width="1.5"
                                 stroke="currentColor"
                                 class="h-6 w-6 text-gray-900 mr-2">
                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      d="M11.42 15.17 17.25 21A2.652 2.652 0 0 0 21 17.25l-5.877-5.877M11.42 15.17l2.496-3.03c.317-.384.74-.626 1.208-.766M11.42 15.17l-4.655 5.653a2.548 2.548 0 1 1-3.586-3.586l6.837-5.63m5.108-.233c.55-.164 1.163-.188 1.743-.14a4.5 4.5 0 0 0 4.486-6.336l-3.276 3.277a3.004 3.004 0 0 1-2.25-2.25l3.276-3.276a4.5 4.5 0 0 0-6.336 4.486c.091 1.076-.071 2.264-.904 2.95l-.102.085m-1.745 1.437L5.909 7.5H4.5L2.25 3.75l1.5-1.5L7.5 4.5v1.409l4.26 4.26m-1.745 1.437 1.745-1.437m6.615 8.206L15.75 15.75M4.867 19.125h.008v.008h-.008v-.008Z" />
                            </svg>
                            <span class="text-sm font-medium text-gray-900">Meistrų ir remonto paslaugos</span>
                        </div>
                        <svg xmlns="http://www.w3.org/2000/svg"
                             fill="none"
                             viewBox="0 0 24 24"
                             stroke-width="1.5"
                             stroke="currentColor"
                             class="h-4 w-4 text-gray-500">
                            <path stroke-linecap="round"
                                  stroke-linejoin="round"
                                  d="M9 5l7 7-7 7" />
                        </svg>
                    </a>

                    <a href="#" class="flex items-center justify-between rounded-lg border border-gray-200 bg-primary-backgroundlight px-4 py-2 hover:bg-primary-backgrounddark md:mt-8 mb-2">
                        <div class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg"
                                 fill="none"
                                 viewBox="0 0 24 24"
                                 stroke-width="1.5"
                                 stroke="currentColor"
                                 class="h-6 w-6 text-gray-900 mr-2">
                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      d="M6 12 3.269 3.125A59.769 59.769 0 0 1 21.485 12 59.768 59.768 0 0 1 3.27 20.875L5.999 12Zm0 0h7.5" />
                            </svg>
                            <span class="text-sm font-medium text-gray-900">Perkraustymas ir transportas</span>
                        </div>
                        <svg xmlns="http://www.w3.org/2000/svg"
                             fill="none"
                             viewBox="0 0 24 24"
                             stroke-width="1.5"
                             stroke="currentColor"
                             class="h-4 w-4 text-gray-500">
                            <path stroke-linecap="round"
                                  stroke-linejoin="round"
                                  d="M9 5l7 7-7 7" />
                        </svg>
                    </a>
                </div>
            </div>
        </section>

        <!-- Skiriamoji juosta -->
        <div class="flex justify-center items-center space-x-2 mx-auto max-w-md ">
            <hr class="w-16 h-1 bg-primary-light border-0 rounded md:my-12 opacity-50">
            <hr class="w-16 h-1 bg-primary-light border-0 rounded md:my-12 opacity-50">
            <hr class="w-16 h-1 bg-primary-light border-0 rounded md:my-12 opacity-50">
        </div>

        <!-- kaip mes veikiame -->
        <section class="pt-8 pb-24 relative">
            <div class="w-full max-w-7xl px-4 md:px-5 lg:px-5 mx-auto">
                <div class="w-full flex-col justify-start items-center lg:gap-12 gap-10 inline-flex">
                    <div class="w-full flex-col justify-start items-center gap-3 flex">
                        <h2 class="w-full text-center text-primary-light text-4xl font-bold font-manrope leading-normal">Kaip viskas veikia</h2>
                        <p class="w-full text-center text-gray-500 text-base font-normal leading-relaxed">MyApp Lietuva padeda jum rasti freelancerio pagalba naujovišku budu  <br/>Nesvarbu kokia jūsų problema, mūsų partneriai jums padės</p>
                    </div>
                    <div class="w-full justify-start items-center gap-4 flex md:flex-row flex-col">
                        <div class="grow shrink basis-0 flex-col justify-start items-center gap-2.5 inline-flex">
                            <div class="self-stretch flex-col justify-start items-center gap-0.5 flex">
                                <h3 class="self-stretch text-center text-primary-light text-4xl font-extrabold font-manrope leading-normal">1</h3>
                                <h4 class="self-stretch text-center text-primary text-xl font-semibold leading-8">Suraskite problemą atitinkančia kategoriją</h4>
                            </div>
                            <p class="self-stretch text-center text-gray-500 text-base font-normal leading-relaxed">Naudokites paieškos langeliu arba ieškokite tarp visų kategorijų, išsirinkite sau tinkamą.</p>
                        </div>
                        <svg class="md:flex hidden" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <path d="M5.50159 6L11.5018 12.0002L5.49805 18.004M12.5016 6L18.5018 12.0002L12.498 18.004" stroke="#266867" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        <div class="grow shrink basis-0 flex-col justify-start items-center gap-2.5 inline-flex">
                            <div class="self-stretch flex-col justify-start items-center gap-0.5 flex">
                                <h3 class="self-stretch text-center text-primary-light text-4xl font-extrabold font-manrope leading-normal">2</h3>
                                <h4 class="self-stretch text-center text-primary  text-xl font-semibold leading-8">Išsirinkite patinkantį freelancerį</h4>
                            </div>
                            <p class="self-stretch text-center text-gray-500 text-base font-normal leading-relaxed">Mes parinksime jums tinkamiausius freelancerius pagal vietove, įvertinimą ir paslaugos tipą.</p>
                        </div>
                        <svg class="md:flex hidden" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <path d="M5.50159 6L11.5018 12.0002L5.49805 18.004M12.5016 6L18.5018 12.0002L12.498 18.004" stroke="#266867" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        <div class="grow shrink basis-0 flex-col justify-start items-center gap-2.5 inline-flex">
                            <div class="self-stretch flex-col justify-start items-center gap-0.5 flex">
                                <h3 class="self-stretch text-center text-primary-light text-4xl font-extrabold font-manrope leading-normal">3</h3>
                                <h4 class="self-stretch text-center text-primary  text-xl font-semibold leading-8">Susisiekite su freelanceriu</h4>
                            </div>
                            <p class="self-stretch text-center text-gray-500 text-base font-normal leading-relaxed">Susisiekite ir susitarkite. O tada belieka tik laukti ! Po paslaugos nepamirškite palikti atsiliepimą.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>



@endsection

@section('script')
    <script>

                document.addEventListener("DOMContentLoaded", () => {
                    const tabButtons = document.querySelectorAll("[data-tabs-target]");
                    const tabContents = document.querySelectorAll("[role='tabpanel']");

                    // Function to handle tab switching
                    const switchTab = (targetId) => {
                        tabContents.forEach((tabContent) => {
                            if (tabContent.id === targetId) {
                                tabContent.classList.remove("hidden");
                            } else {
                                tabContent.classList.add("hidden");
                            }
                        });

                        tabButtons.forEach((tabButton) => {
                            if (tabButton.getAttribute("data-tabs-target") === `#${targetId}`) {
                                tabButton.classList.add("text-purple-600", "border-purple-600");
                                tabButton.classList.remove("hover:text-gray-600", "hover:border-gray-300");
                            } else {
                                tabButton.classList.remove("text-purple-600", "border-purple-600");
                                tabButton.classList.add("hover:text-gray-600", "hover:border-gray-300");
                            }
                        });
                    };

                    // Add event listeners to all tab buttons
                    tabButtons.forEach((button) => {
                        button.addEventListener("click", () => {
                            const targetId = button.getAttribute("data-tabs-target").substring(1);
                            switchTab(targetId);
                        });
                    });

                    // Initialize the first tab as active
                    if (tabButtons.length > 0) {
                        const firstTabId = tabButtons[0].getAttribute("data-tabs-target").substring(1);
                        switchTab(firstTabId);
                    }
                });

    </script>

@endsection

    @extends('layouts.navbar')
