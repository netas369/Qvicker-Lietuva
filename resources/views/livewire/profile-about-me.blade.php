<div class="space-y-4">
    <div class="flex items-center justify-between">
        <div class="flex items-center">
            <div class="bg-primary-light/10 p-2 rounded-lg mr-3">
                <svg class="w-6 h-6 text-primary-light" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                </svg>
            </div>
            <h2 class="text-xl font-bold text-gray-800">Apie Mane</h2>
        </div>

        <div class="flex items-center text-sm min-h-[24px]">
            <div wire:loading wire:target="aboutMe" class="flex items-center text-blue-600">
                <svg class="animate-spin h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
                Saugoma...
            </div>
            <div
                x-data="{ show: false }"
                x-show="show"
                x-transition
                @about-me-saved.window="show = true; setTimeout(() => show = false, 2000)"
                class="flex items-center text-green-600"
                style="display: none;"
            >
                <svg class="h-4 w-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
                Išsaugota
            </div>
        </div>
    </div>

    <div class="bg-primary-dark/20 border-l-4 border-primary-dark rounded-xl p-4 shadow-sm">
        <div class="flex items-start">
            <div class="ml-3 text-sm text-primary">
                @if($user->role === 'provider')
                    <p>Aprašykite savo patirtį išsamiai, kad klientai jumis pasitikėtų.</p>
                @else
                    <p>Apibūdinkite save, kad meistrai geriau suprastų jūsų poreikius.</p>
                @endif
            </div>
        </div>
    </div>

    <div x-data="editorComponent()" class="space-y-2">
        <div class="flex flex-wrap items-center gap-1 p-2 bg-gray-50 border border-gray-300 border-b-0 rounded-t-xl">
            <button type="button" @click="wrapText('**', '**')" class="p-2 rounded-lg hover:bg-gray-200" title="Paryškinti (Bold)">
                <span class="font-bold text-gray-700">B</span>
            </button>

            <button type="button" @click="wrapText('*', '*')" class="p-2 rounded-lg hover:bg-gray-200" title="Pasvirusi (Italic)">
                <span class="italic text-gray-700 font-serif">I</span>
            </button>

            <div class="w-px h-6 bg-gray-300 mx-1"></div>

            <button type="button" @click="insertPrefix('• ')" class="p-2 rounded-lg hover:bg-gray-200" title="Sąrašo punktas">
                <svg class="w-4 h-4 text-gray-700" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><line x1="9" y1="6" x2="20" y2="6"></line><line x1="9" y1="12" x2="20" y2="12"></line><line x1="9" y1="18" x2="20" y2="18"></line><circle cx="4" cy="6" r="2" fill="currentColor"></circle><circle cx="4" cy="12" r="2" fill="currentColor"></circle><circle cx="4" cy="18" r="2" fill="currentColor"></circle></svg>
            </button>

            <button type="button" @click="insertPrefix('✓ ')" class="p-2 rounded-lg hover:bg-gray-200" title="Įgūdis">
                <svg class="w-4 h-4 text-gray-700" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"></path></svg>
            </button>
        </div>

        <textarea
            x-ref="textarea"
            wire:model.live.debounce.1000ms="aboutMe"
            class="w-full rounded-b-xl rounded-t-none border-gray-300 shadow-sm focus:border-primary-light focus:ring-primary-light focus:ring-opacity-50 min-h-[150px]"
            rows="6"
            placeholder="Rašykite čia..."
        ></textarea>

        @error('aboutMe') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
    </div>

    @if(!empty($aboutMe))
        <div x-data="{ showPreview: false }" class="mt-4">
            <button type="button" @click="showPreview = !showPreview" class="text-sm text-primary-light hover:underline">
                <span x-text="showPreview ? 'Slėpti peržiūrą' : 'Peržiūrėti rezultatą'"></span>
            </button>
            <div x-show="showPreview" class="mt-3 p-4 bg-gray-50 rounded-xl border border-gray-200 prose prose-sm max-w-none">
                {!! \Illuminate\Support\Str::markdown($aboutMe) !!}
            </div>
        </div>
    @endif
</div>

<script>
    function editorComponent() {
        return {
            insertText(text) {
                this.modifyText((current, start, end) => {
                    return current.substring(0, start) + text + current.substring(end);
                }, text.length);
            },
            insertPrefix(prefix) {
                this.modifyText((current, start, end) => {
                    // Check if we are on a new line, if not add \n
                    let pre = (start > 0 && current[start - 1] !== '\n') ? '\n' : '';
                    return current.substring(0, start) + pre + prefix + current.substring(end);
                }, prefix.length);
            },
            wrapText(before, after) {
                this.modifyText((current, start, end) => {
                    const selectedText = current.substring(start, end);
                    // If nothing selected, just insert markers
                    if (!selectedText) return current.substring(0, start) + before + 'text' + after + current.substring(end);
                    return current.substring(0, start) + before + selectedText + after + current.substring(end);
                }, after.length); // approximate cursor move
            },
            modifyText(callback, cursorOffset) {
                const el = this.$refs.textarea;
                const start = el.selectionStart;
                const end = el.selectionEnd;
                const current = el.value;

                const newValue = callback(current, start, end);

                // This magic line updates Livewire directly without waiting for debounce
            @this.set('aboutMe', newValue);

                // Reset cursor focus
                this.$nextTick(() => {
                    el.focus();
                    const newCursor = start + cursorOffset; // Simplified cursor logic
                    el.setSelectionRange(newCursor, newCursor);
                });
            }
        }
    }
</script>
