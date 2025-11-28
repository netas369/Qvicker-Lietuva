@props([
    'selectedLanguages' => [],
    'availableLanguages' => [],
    'error' => null
])

<div>
    <label class="block text-sm font-medium text-gray-700 mb-1">
        Kalbos <span class="text-red-500">*</span>
    </label>

    <div class="space-y-3">
        <!-- Language Selector -->
        <div class="flex gap-2">
            <select wire:model="newLanguage"
                    class="flex-1 rounded-md border-gray-300 shadow-sm focus:border-primary-light focus:ring focus:ring-primary-light focus:ring-opacity-50">
                <option value="">Pasirinkite kalbą...</option>
                @foreach($availableLanguages as $lang)
                    @if(!in_array($lang, $selectedLanguages))
                        <option value="{{ $lang }}">{{ $lang }}</option>
                    @endif
                @endforeach
            </select>
            <button type="button" wire:click="addLanguage"
                    class="px-4 py-2 bg-primary-light text-white rounded-md hover:bg-primary">
                Pridėti
            </button>
        </div>

        <!-- Selected Languages Tags -->
        @if(count($selectedLanguages) > 0)
            <div class="flex flex-wrap gap-2">
                @foreach($selectedLanguages as $index => $language)
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm bg-primary-light text-white">
                        {{ $language }}
                        <button type="button" wire:click="removeLanguage({{ $index }})"
                                class="ml-2 hover:text-gray-200">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/>
                            </svg>
                        </button>
                    </span>
                @endforeach
            </div>
        @endif
    </div>

    @if($error)
        <p class="mt-1 text-sm text-red-600">{{ $error }}</p>
    @endif
</div>
