<div>
    <div>
        <div class="bg-white rounded-lg shadow-sm p-6">
            <!-- Header -->
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-xl font-medium text-gray-800">Darbo Kategorijos</h2>
                @if(session()->has('message'))
                    <div class="bg-green-100 text-green-700 px-4 py-2 rounded-md">
                        {{ session('message') }}
                    </div>
                @endif
            </div>

            <!-- Current Categories Display -->
            <div class="mb-8">
                <h3 class="text-lg font-medium text-gray-700 mb-3">Jūsų pasirinktos kategorijos</h3>

                @if(count($selectedCategories) > 0)
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-3">
                        @php
                            $userCategories = \App\Models\Category::whereIn('id', $selectedCategories)
                                ->get()
                                ->groupBy('category');
                        @endphp

                        @foreach($userCategories as $mainCategory => $subcategories)
                            <div class="bg-blue-50 rounded-lg border border-blue-200 p-3">
                                <h4 class="font-medium text-blue-800 border-b border-blue-200 pb-2 mb-2">{{ $mainCategory }}</h4>
                                <ul class="space-y-2">
                                    @foreach($subcategories as $subcategory)
                                        <li class="flex items-start group">
                                            <span class="text-sm text-gray-700 flex-grow">{{ $subcategory->subcategory }}</span>
                                            <button
                                                wire:click="toggleCategory({{ $subcategory->id }})"
                                                class="text-red-500 opacity-0 group-hover:opacity-100 transition-opacity"
                                                title="Pašalinti kategoriją">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                                                </svg>
                                            </button>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="bg-gray-50 rounded-lg p-4 text-center text-gray-500">
                        Nėra pasirinktų darbo kategorijų
                    </div>
                @endif
            </div>

            <!-- Add New Categories Section -->
            <div>
                <h3 class="text-lg font-medium text-gray-700 mb-3">Pridėti naujas kategorijas</h3>

                <div class="space-y-4">
                    @foreach($groupedCategories as $mainCategory => $subcategories)
                        <div class="border rounded-lg p-4">
                            <h4 class="font-medium text-gray-800 mb-3">{{ $mainCategory }}</h4>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-2">
                                @foreach($subcategories as $subcategory)
                                    @if(!in_array($subcategory['id'], $selectedCategories))
                                        <div class="flex items-center space-x-2">
                                            <button
                                                wire:click="toggleCategory({{ $subcategory['id'] }})"
                                                class="inline-flex items-center px-3 py-1 text-sm bg-green-50 text-green-700 rounded-full border border-green-200 hover:bg-green-100 transition-colors">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v2H7a1 1 0 100 2h2v2a1 1 0 102 0v-2h2a1 1 0 100-2h-2V7z" clip-rule="evenodd" />
                                                </svg>
                                                {{ $subcategory['subcategory'] }}
                                            </button>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Save Button -->
            <div class="mt-8 flex justify-end">
                <button
                    wire:click="saveCategories"
                    class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 active:bg-blue-800 transition duration-150 ease-in-out">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                    </svg>
                    Išsaugoti pakeitimus
                </button>
            </div>
        </div>
    </div>
</div>
