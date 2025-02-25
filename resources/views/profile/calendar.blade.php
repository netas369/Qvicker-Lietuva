@extends('layouts.main')

@section('content')
    <!-- Your navigation code remains the same -->

    <div class="container mx-auto px-4 py-8">
        <div class="max-w-2xl mx-auto bg-white rounded-lg shadow-md p-6">
            <h2 class="text-xl sm:text-2xl font-bold mb-6 text-center text-primary">Pasirinkite nedarbo dienas</h2>

            <form \ method="POST">
                @csrf

                <div class="space-y-6">
                    <!-- Date Range Picker -->
                    <div class="date-range-container">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <!-- Start Date -->
                            <div class="form-group">
                                <label for="start_date" class="block text-sm font-medium text-gray-700 mb-1">Pradžios data</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                    </div>
                                    <input type="text" id="start_date" name="start_date" class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-primary-light focus:border-primary-light sm:text-sm" placeholder="Pasirinkite pradžios datą">
                                </div>
                            </div>

                            <!-- End Date -->
                            <div class="form-group">
                                <label for="end_date" class="block text-sm font-medium text-gray-700 mb-1">Pabaigos data</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                    </div>
                                    <input type="text" id="end_date" name="end_date" class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-primary-light focus:border-primary-light sm:text-sm" placeholder="Pasirinkite pabaigos datą">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Selected Dates Summary -->
                    <div id="date-summary" class="hidden p-4 bg-gray-50 rounded-md">
                        <h3 class="font-medium text-gray-700 mb-2">Pasirinktos datos:</h3>
                        <div class="flex flex-col sm:flex-row sm:justify-between items-start sm:items-center">
                            <div>
                                <span class="text-sm text-gray-500">Nuo:</span>
                                <span id="summary-start-date" class="ml-2 font-medium"></span>
                            </div>
                            <div class="mt-2 sm:mt-0">
                                <span class="text-sm text-gray-500">Iki:</span>
                                <span id="summary-end-date" class="ml-2 font-medium"></span>
                            </div>
                            <div class="mt-2 sm:mt-0">
                                <span class="text-sm text-gray-500">Iš viso dienų:</span>
                                <span id="total-days" class="ml-2 font-medium"></span>
                            </div>
                        </div>
                    </div>

                    <div class="flex justify-center">
                        <button type="submit" class="w-1/2 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-primary-light hover:bg-primary-dark focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-light">
                            Pridėti
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection
