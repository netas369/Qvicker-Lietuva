<div>
    <div>
        <div class="bg-white rounded-lg shadow-sm p-6">
            <!-- Header -->
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-2xl font-bold text-primary">Darbo Kategorijos</h2>
                <div>
                    @if(session()->has('message'))
                        <div
                            wire:key="notification-{{ rand() }}"
                            x-data="{ show: true }"
                            x-init="setTimeout(() => { show = false }, 5000)"
                            x-show="show"
                            x-transition:leave="transition ease-in duration-300"
                            x-transition:leave-start="opacity-100"
                            x-transition:leave-end="opacity-0"
                            class="px-3 py-1.5 rounded-md text-sm {{ session('messageType') == 'removed' ? 'bg-red-100 text-red-700' : 'bg-green-100 text-green-700' }}">
                            {{ session('message') }}
                        </div>
                    @endif
                </div>
            </div>

            <!-- Current Categories Display -->
            <div class="mb-8">
                <h3 class="text-lg font-medium text-primary mb-3">Jūsų pasirinktos kategorijos</h3>

                @if(count($selectedCategories) > 0)
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-3">
                        @php
                            $userCategories = \App\Models\Category::whereIn('id', $selectedCategories)
                                ->get()
                                ->groupBy('category');
                        @endphp

                        @foreach($userCategories as $mainCategory => $subcategories)
                            <div class="rounded-lg border border-primary p-3">
                                <h4 class="font-medium text-primary border-b border-primary-light pb-2 mb-2">{{ $mainCategory }}</h4>
                                <ul class="space-y-2">
                                    @foreach($subcategories as $subcategory)
                                        <li class="flex items-start group">
                                            <span class="text-sm text-gray-700 flex-grow">{{ $subcategory->subcategory }}</span>
                                            <button
                                                wire:click="toggleCategory({{ $subcategory->id }})"
                                                class="text-red-500 opacity-80 group-hover:opacity-100 transition-opacity"
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
                <h3 class="text-lg font-medium text-primary mb-3">Pridėti naujas kategorijas</h3>

                <div class="space-y-4">
                    @foreach($groupedCategories as $mainCategory => $subcategories)
                        <div class="border rounded-lg p-4">
                            <h4 class="font-medium text-primary mb-3">{{ $mainCategory }}</h4>
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
        </div>
    </div>
</div>
