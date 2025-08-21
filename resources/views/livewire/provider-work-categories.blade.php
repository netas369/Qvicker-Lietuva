<div
    x-data="{
        showConfirm: false,
        categoryId: null,
        categoryName: '',
        scrollToCategory(categoryId) {
            this.$nextTick(() => {
                const element = document.getElementById('category-' + categoryId);
                if (element) {
                    element.scrollIntoView({
                        behavior: 'smooth',
                        block: 'center'
                    });
                    // Add highlight effect
                    element.classList.add('ring-2', 'ring-green-500', 'ring-opacity-50');
                    setTimeout(() => {
                        element.classList.remove('ring-2', 'ring-green-500', 'ring-opacity-50');
                    }, 3000);
                }
            });
        }
    }"
    @category-added.window="scrollToCategory($event.detail.categoryId)"
>

    <!-- Add Category Modal -->
    <div
        x-show="$wire.showAddModal"
        x-cloak
        class="fixed inset-0 z-50 overflow-y-auto"
        aria-labelledby="modal-title"
        role="dialog"
        aria-modal="true"
    >
        <!-- Modal content remains the same -->
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <!-- Background overlay -->
            <div
                x-show="$wire.showAddModal"
                x-transition:enter="ease-out duration-300"
                x-transition:enter-start="opacity-0"
                x-transition:enter-end="opacity-100"
                x-transition:leave="ease-in duration-200"
                x-transition:leave-start="opacity-100"
                x-transition:leave-end="opacity-0"
                class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"
                @click="$wire.showAddModal = false"
                aria-hidden="true"
            ></div>

            <!-- Modal panel -->
            <div
                x-show="$wire.showAddModal"
                x-transition:enter="ease-out duration-300"
                x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                x-transition:leave="ease-in duration-200"
                x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                class="relative inline-block align-bottom bg-white rounded-lg px-4 pt-5 pb-4 text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full sm:p-6"
            >
                <div class="mb-4">
                    <h3 class="text-lg leading-6 font-medium text-gray-900">
                        Pridėti kategoriją: {{ $newCategoryName }}
                    </h3>
                    <p class="mt-2 text-sm text-gray-500">
                        Užpildykite reikalingus duomenis kategorijos pridėjimui.
                    </p>
                </div>

                <div class="space-y-4">
                    <!-- Price -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Kaina <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <input type="number"
                                   wire:model="newCategoryPrice"
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent"
                                   placeholder="Įveskite kainą"
                                   min="0"
                                   step="0.01"
                                   required>
                            <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                <span class="text-gray-500 text-sm">€</span>
                            </div>
                        </div>
                        @error('newCategoryPrice')
                        <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Price Type -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Kainos tipas <span class="text-red-500">*</span>
                        </label>
                        <select wire:model="newCategoryType"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent"
                                required>
                            <option value="">Pasirinkite tipą</option>
                            <option value="hourly">Valandinis</option>
                            <option value="fixed">Fiksuotas</option>
                            <option value="meter">Metrinis</option>
                        </select>
                        @error('newCategoryType')
                        <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Experience -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Patirtis (metais) <span class="text-gray-400 text-xs">(neprivaloma)</span>
                        </label>
                        <input type="number"
                               wire:model="newCategoryExperience"
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent"
                               placeholder="Metai"
                               min="0"
                               max="50">
                        @error('newCategoryExperience')
                        <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="mt-5 sm:mt-4 sm:flex sm:flex-row-reverse">
                    <button
                        type="button"
                        wire:click="addCategoryWithData"
                        wire:loading.attr="disabled"
                        class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-green-600 text-base font-medium text-white hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 sm:ml-3 sm:w-auto sm:text-sm disabled:opacity-50"
                    >
                        <span wire:loading.remove>Pridėti kategoriją</span>
                        <span wire:loading>Pridedama...</span>
                    </button>
                    <button
                        type="button"
                        wire:click="$set('showAddModal', false)"
                        class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 sm:mt-0 sm:w-auto sm:text-sm"
                    >
                        Atšaukti
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div>
        <div class="bg-white rounded-lg shadow-sm p-6">
            <!-- Header with Notification -->
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-8">
                <h2 class="text-2xl md:text-3xl font-bold text-primary-light">Darbo Kategorijos</h2>

                @if($notification)
                    <div
                        wire:key="notification-{{ now() }}"
                        x-data="{ show: true }"
                        x-init="setTimeout(() => { show = false; $wire.clearNotification() }, 5000)"
                        x-show="show"
                        x-transition:enter="transition ease-out duration-300"
                        x-transition:enter-start="opacity-0 transform translate-y-2"
                        x-transition:enter-end="opacity-100 transform translate-y-0"
                        x-transition:leave="transition ease-in duration-300"
                        x-transition:leave-start="opacity-100 transform translate-y-0"
                        x-transition:leave-end="opacity-0 transform translate-y-2"
                        class="{{ $notification['type'] == 'removed'
                            ? 'bg-red-50 text-red-700 border-red-200'
                            : 'bg-green-50 text-green-700 border-green-200' }}
                            flex items-center px-4 py-2 rounded-lg border shadow-sm"
                    >
                        <div class="mr-3">
                            @if($notification['type'] == 'removed')
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-red-500" viewBox="0 0 20 20"
                                     fill="currentColor" aria-hidden="true">
                                    <path fill-rule="evenodd"
                                          d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                                          clip-rule="evenodd"/>
                                </svg>
                            @else
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-500"
                                     viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                    <path fill-rule="evenodd"
                                          d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                          clip-rule="evenodd"/>
                                </svg>
                            @endif
                        </div>
                        <span class="text-sm font-medium">{{ $notification['message'] }}</span>
                        <button
                            @click="show = false; $wire.clearNotification()"
                            class="ml-auto -mr-1 rounded-full p-1 hover:bg-white transition-colors"
                        >
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 opacity-70" fill="none"
                                 viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                        </button>
                    </div>
                @endif
            </div>

            <!-- Selected Categories Section -->
            <div class="space-y-6 p-5 bg-gray-50 rounded-lg border border-gray-200">
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <div class="p-2 bg-primary-50 rounded-full mr-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-primary-600" fill="none"
                                 viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M5 13l4 4L19 7"/>
                            </svg>
                        </div>
                        <h3 class="text-md md:text-xl font-bold text-primary">Jūsų pasirinktos kategorijos</h3>
                    </div>
                    <span
                        class="px-2.5 py-1 text-xs font-medium rounded-full {{ count($selectedCategories) > 0 ? 'bg-primary-50 text-primary-700' : 'bg-gray-100 text-gray-500' }}">
                        {{ count($selectedCategories) }} {{ count($selectedCategories) == 1 ? 'kategorija' : 'kategorijos' }}
                    </span>
                </div>

                @if(count($selectedCategories) > 0)
                    <div class="space-y-6">
                        @foreach($userCategories as $mainCategory => $subcategories)
                            <div wire:key="main-{{ $loop->index }}" class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                                <div class="bg-gray-50 px-4 py-3 border-b border-gray-200">
                                    <h4 class="font-medium text-gray-800">{{ $mainCategory }}</h4>
                                </div>
                                <div class="divide-y divide-gray-100">
                                    @foreach($subcategories as $subcategory)
                                        <div wire:key="sub-{{ $subcategory['id'] }}"
                                             id="category-{{ $subcategory['id'] }}"
                                             class="p-4 transition-all duration-300">
                                            <!-- Subcategory Header -->
                                            <div class="flex items-center justify-between mb-4">
                                                <h5 class="font-medium text-gray-900">{{ $subcategory['subcategory'] }}</h5>
                                                <button
                                                    @click="categoryId = {{ $subcategory['id'] }}; categoryName = '{{ addslashes($subcategory['subcategory']) }}'; showConfirm = true"
                                                    class="text-gray-400 hover:text-red-500 transition-colors p-1 rounded-full hover:bg-gray-100"
                                                    title="Pašalinti kategoriją">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4"
                                                         viewBox="0 0 20 20" fill="currentColor">
                                                        <path fill-rule="evenodd"
                                                              d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                                                              clip-rule="evenodd"/>
                                                    </svg>
                                                </button>
                                            </div>

                                            <!-- Editable Fields -->
                                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                                <!-- Price -->
                                                <div>
                                                    <label class="block text-sm font-medium text-gray-700 mb-2">
                                                        Kaina <span class="text-red-500">*</span>
                                                    </label>
                                                    <div class="relative">
                                                        <input type="number"
                                                               wire:model.lazy="categoryPrices.{{ $subcategory['id'] }}"
                                                               wire:change="updateCategoryData({{ $subcategory['id'] }}, 'price', $event.target.value)"
                                                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent"
                                                               placeholder="Įveskite kainą"
                                                               min="0"
                                                               step="0.01"
                                                               required>
                                                        <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                                            <span class="text-gray-500 text-sm">€</span>
                                                        </div>
                                                    </div>
                                                    @error("categoryPrices.{$subcategory['id']}")
                                                    <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                                                    @enderror
                                                </div>

                                                <!-- Price Type -->
                                                <div>
                                                    <label class="block text-sm font-medium text-gray-700 mb-2">
                                                        Kainos tipas <span class="text-red-500">*</span>
                                                    </label>
                                                    <select wire:model.lazy="categoryTypes.{{ $subcategory['id'] }}"
                                                            wire:change="updateCategoryData({{ $subcategory['id'] }}, 'type', $event.target.value)"
                                                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent"
                                                            required>
                                                        <option value="">Pasirinkite tipą</option>
                                                        <option value="hourly">Valandinis</option>
                                                        <option value="fixed">Fiksuotas</option>
                                                        <option value="meter">Metrinis</option>
                                                    </select>
                                                    @error("categoryTypes.{$subcategory['id']}")
                                                    <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                                                    @enderror
                                                </div>

                                                <!-- Experience -->
                                                <div>
                                                    <label class="block text-sm font-medium text-gray-700 mb-2">
                                                        Patirtis (metais) <span class="text-gray-400 text-xs">(neprivaloma)</span>
                                                    </label>
                                                    <input type="number"
                                                           wire:model.lazy="categoryExperience.{{ $subcategory['id'] }}"
                                                           wire:change="updateCategoryData({{ $subcategory['id'] }}, 'experience', $event.target.value)"
                                                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent"
                                                           placeholder="Metai"
                                                           min="0"
                                                           max="50">
                                                    @error("categoryExperience.{$subcategory['id']}")
                                                    <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <!-- Current Values Display -->
                                            <div class="mt-3 flex flex-wrap gap-2 text-xs text-gray-600">
                                                @if($subcategory['price'])
                                                    <span class="bg-blue-100 text-blue-700 px-2 py-1 rounded">
                                                        {{ $subcategory['price'] }}€
                                                    </span>
                                                @endif
                                                @if($subcategory['type'])
                                                    <span class="bg-green-100 text-green-700 px-2 py-1 rounded">
                                                        {{ $subcategory['type'] === 'hourly' ? 'Valandinis' : ($subcategory['type'] === 'fixed' ? 'Fiksuotas' : 'Metrinis') }}
                                                    </span>
                                                @endif
                                                @if($subcategory['experience'])
                                                    <span class="bg-purple-100 text-purple-700 px-2 py-1 rounded">
                                                        {{ $subcategory['experience'] }} m. patirtis
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="bg-gray-50 rounded-xl p-8 text-center">
                        <div class="flex flex-col items-center justify-center space-y-3">
                            <div class="p-3 bg-gray-100 rounded-full">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-400" fill="none"
                                     viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                                </svg>
                            </div>
                            <p class="text-gray-500">Nėra pasirinktų darbo kategorijų</p>
                        </div>
                    </div>
                @endif
            </div>

            <!-- Improved Add New Categories Section -->
            <div class="space-y-6 mt-10 p-5 bg-white rounded-lg border border-gray-200">
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <div class="p-2 bg-green-50 rounded-full mr-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-primary">Pridėti naujas kategorijas</h3>
                    </div>
                </div>

                <div class="space-y-5">
                    @foreach($groupedCategories as $mainCategory => $subcategories)
                        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                            <div
                                class="bg-gray-50 px-4 py-3 border-b border-gray-200 flex items-center justify-between">
                                <h4 class="font-medium text-gray-800">{{ $mainCategory }}</h4>
                                <span class="text-xs font-medium text-gray-500">
                                    {{ count(array_filter($subcategories, function($sub) { return !in_array($sub['id'], $this->selectedCategories); })) }} nepasirinktos
                                </span>
                            </div>

                            <div class="p-4">
                                <div class="flex flex-wrap gap-2">
                                    @foreach($subcategories as $subcategory)
                                        @if(!in_array($subcategory['id'], $selectedCategories))
                                            <button
                                                wire:click="openAddModal({{ $subcategory['id'] }})"
                                                class="group flex items-center px-3 py-1.5 text-sm bg-white text-gray-700 rounded-lg border border-gray-200 hover:border-primary-300 hover:bg-primary-50 transition-all duration-200"
                                            >
                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                     class="h-4 w-4 mr-1.5 text-gray-400 group-hover:text-primary-500 transition-colors"
                                                     viewBox="0 0 20 20" fill="currentColor">
                                                    <path fill-rule="evenodd"
                                                          d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v2H7a1 1 0 100 2h2v2a1 1 0 102 0v-2h2a1 1 0 100-2h-2V7z"
                                                          clip-rule="evenodd"/>
                                                </svg>
                                                {{ $subcategory['subcategory'] }}
                                            </button>
                                        @endif
                                    @endforeach

                                    @if(!count(array_filter($subcategories, function($sub) { return !in_array($sub['id'], $this->selectedCategories); })))
                                        <div class="w-full py-2 text-center text-sm text-gray-500 italic">
                                            Visos šios kategorijos jau pasirinktos
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach

                    @if(count($groupedCategories) === 0)
                        <div class="bg-gray-50 rounded-xl p-8 text-center">
                            <p class="text-gray-500">
                                @if(empty($searchQuery))
                                    Nėra papildomų kategorijų
                                @else
                                    Nerasta kategorijų pagal paiešką "{{ $searchQuery }}"
                                @endif
                            </p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Confirmation Modal (Only for Removals) -->
    <div
        x-show="showConfirm"
        x-cloak
        class="fixed inset-0 z-50 overflow-y-auto"
        aria-labelledby="modal-title"
        role="dialog"
        aria-modal="true"
    >
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <!-- Background overlay -->
            <div
                x-show="showConfirm"
                x-transition:enter="ease-out duration-300"
                x-transition:enter-start="opacity-0"
                x-transition:enter-end="opacity-100"
                x-transition:leave="ease-in duration-200"
                x-transition:leave-start="opacity-100"
                x-transition:leave-end="opacity-0"
                class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"
                @click="showConfirm = false"
                aria-hidden="true"
            ></div>

            <!-- Modal panel -->
            <div
                x-show="showConfirm"
                x-transition:enter="ease-out duration-300"
                x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                x-transition:leave="ease-in duration-200"
                x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                class="relative inline-block align-bottom bg-white rounded-lg px-4 pt-5 pb-4 text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full sm:p-6"
            >
                <div class="sm:flex sm:items-start">
                    <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
                        <svg class="h-6 w-6 text-red-600" xmlns="http://www.w3.org/2000/svg" fill="none"
                             viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                        </svg>
                    </div>
                    <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                        <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">
                            Ar tikrai norite pašalinti kategoriją?
                        </h3>
                        <div class="mt-2">
                            <p class="text-sm text-gray-500" x-text="'Kategorija „' + categoryName + '" bus pašalinta iš jūsų pasirinkimų.'">
                            </p>
                        </div>
                    </div>
                </div>
                <div class="mt-5 sm:mt-4 sm:flex sm:flex-row-reverse">
                    <button
                        type="button"
                        class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 text-base font-medium text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm"
                        @click="$wire.removeCategory(categoryId); showConfirm = false"
                    >
                        Taip, pašalinti
                    </button>
                    <button
                        type="button"
                        class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 sm:mt-0 sm:w-auto sm:text-sm"
                        @click="showConfirm = false"
                    >
                        Atšaukti
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
