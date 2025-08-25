@extends('layouts.main')

@section('title', 'Edit SEO Content - ' . ($categoryData->subcategory ?? 'Service'))

@push('styles')
    <style>
        .content-preview {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
            line-height: 1.6;
            color: #374151;
        }
        .content-preview h2 {
            font-size: 1.5rem;
            font-weight: 700;
            margin: 1.5rem 0 1rem 0;
            color: #1f2937;
            border-bottom: 2px solid #e5e7eb;
            padding-bottom: 0.5rem;
        }
        .content-preview h3 {
            font-size: 1.25rem;
            font-weight: 600;
            margin: 1.25rem 0 0.75rem 0;
            color: #374151;
        }
        .content-preview p { margin: 1rem 0; }
        .content-preview ul, .content-preview ol {
            margin: 1rem 0;
            padding-left: 1.5rem;
        }
        .content-preview li { margin: 0.5rem 0; }
        .content-preview strong {
            font-weight: 600;
            color: #1f2937;
        }
    </style>
@endpush

@section('content')
    <div class="py-8 bg-gray-50 min-h-screen">
        <div class="container mx-auto px-4 sm:px-6 md:px-10 lg:px-20 xl:px-40 2xl:px-60">

            <!-- Header -->
            <div class="bg-white rounded-lg shadow-sm p-6 mb-6">
                <div class="flex justify-between items-center">
                    <div>
                        <h1 class="text-2xl font-bold text-gray-900">Edit SEO Content</h1>
                        <p class="text-gray-600 mt-1">{{ $categoryData->subcategory }} - {{ $categoryData->category }}</p>
                    </div>
                    <a href="{{ route('admin.service-pages.index') }}"
                       class="px-4 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition">
                        ← Back to List
                    </a>
                </div>
            </div>

            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
                    {{ session('success') }}
                </div>
            @endif

            @if($errors->any())
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
                    <ul class="list-disc pl-5">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Edit Form -->
            <form method="POST" action="{{ route('admin.service-pages.update', $categoryData->url) }}">
                @csrf
                @method('PUT')

                <div class="bg-white rounded-lg shadow-sm mb-6">
                    <div class="p-6 border-b border-gray-200">
                        <h2 class="text-xl font-semibold text-gray-900">Basic SEO Information</h2>
                    </div>

                    <div class="p-6 space-y-6">
                        <!-- Basic SEO Fields -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Page Title *</label>
                                <input type="text" name="title"
                                       value="{{ old('title', $servicePage->title ?? $categoryData->subcategory . ' paslaugos | Qvicker') }}"
                                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                                       required>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Meta Title</label>
                                <input type="text" name="meta_title"
                                       value="{{ old('meta_title', $servicePage->meta_title ?? '') }}"
                                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <p class="text-sm text-gray-500 mt-1">Leave empty to use Page Title</p>
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Meta Description</label>
                            <textarea name="meta_description" rows="3"
                                      class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                                      placeholder="Brief description for search results (150-160 characters)">{{ old('meta_description', $servicePage->meta_description ?? '') }}</textarea>
                            <p class="text-sm text-gray-500 mt-1">Optimal length: 150-160 characters</p>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">H1 Heading</label>
                                <input type="text" name="h1_heading"
                                       value="{{ old('h1_heading', $servicePage->h1_heading ?? '') }}"
                                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Meta Keywords</label>
                                <input type="text" name="meta_keywords"
                                       value="{{ old('meta_keywords', $servicePage->meta_keywords ?? '') }}"
                                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                                       placeholder="keyword1, keyword2, keyword3">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Rich Content Editor -->
                <div class="bg-white rounded-lg shadow-sm mb-6">
                    <div class="p-6 border-b border-gray-200">
                        <div class="flex items-center justify-between">
                            <h2 class="text-xl font-semibold text-gray-900">SEO Content</h2>
                            <div class="flex space-x-2">
                                <button type="button" onclick="loadTemplate('basic')"
                                        class="px-3 py-1 text-sm bg-blue-100 text-blue-700 rounded hover:bg-blue-200 transition">
                                    Load Basic Template
                                </button>
                                <button type="button" onclick="loadTemplate('detailed')"
                                        class="px-3 py-1 text-sm bg-green-100 text-green-700 rounded hover:bg-green-200 transition">
                                    Load Detailed Template
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="p-6">
                        <textarea id="content-editor" name="content">{{ old('content', $servicePage->content ?? '') }}</textarea>
                    </div>
                </div>

                <!-- Preview Section -->
                <div class="bg-white rounded-lg shadow-sm mb-6">
                    <div class="p-6 border-b border-gray-200">
                        <div class="flex items-center justify-between">
                            <h2 class="text-xl font-semibold text-gray-900">Live Preview</h2>
                            <button type="button" onclick="updatePreview()"
                                    class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                                Update Preview
                            </button>
                        </div>
                    </div>
                    <div class="p-6">
                        <div id="content-preview" class="border border-gray-200 rounded-lg p-6 bg-gray-50 content-preview min-h-[200px]">
                            <!-- Preview content will appear here -->
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex justify-between">
                    <a href="{{ route('admin.service-pages.index') }}"
                       class="px-6 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition">
                        Cancel
                    </a>
                    <div class="space-x-3">
                        <a href="/{{ $categoryData->url }}" target="_blank"
                           class="px-6 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-700 transition">
                            Preview Page
                        </a>
                        <button type="submit"
                                class="px-6 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition">
                            {{ $servicePage ? 'Update' : 'Create' }} SEO Page
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/6.8.3/tinymce.min.js"></script>
    <script>
        // Content templates
        const templates = {
            basic: `<h2>Profesionalūs {{ $categoryData->subcategory }} specialistai</h2>
<p>Ieškote patikimo {{ $categoryData->subcategory }} specialisto? Qvicker platformoje rasite geriausius {{ $categoryData->category }} sektorių meistrus visoje Lietuvoje.</p>

<h3>Kodėl rinktis mūsų {{ $categoryData->subcategory }} specialistus?</h3>
<ul>
    <li><strong>Patikrinti specialistai</strong> - visi meistrai yra patikrinti ir turi reikalingą patirtį</li>
    <li><strong>Konkurencingos kainos</strong> - gaukite geriausią kainų ir kokybės santykį</li>
    <li><strong>Greitas aptarnavimas</strong> - dauguma specialistų gali atvykti per 24-48 valandas</li>
    <li><strong>Klientų atsiliepimai</strong> - skaitykite tikrus klientų įvertinimus</li>
</ul>

<p>Pradėkite šiandien ir raskite geriausią {{ $categoryData->subcategory }} specialistą savo rajone!</p>`,

            detailed: `<h2>Profesionalūs {{ $categoryData->subcategory }} specialistai</h2>
<p>Ieškote patikimo {{ $categoryData->subcategory }} specialisto? Qvicker platformoje rasite geriausius {{ $categoryData->category }} sektorių meistrus visoje Lietuvoje.</p>

<h3>Kodėl rinktis mūsų {{ $categoryData->subcategory }} specialistus?</h3>
<ul>
    <li><strong>Patikrinti specialistai</strong> - visi meistrai yra patikrinti ir turi reikalingą patirtį</li>
    <li><strong>Konkurencingos kainos</strong> - gaukite geriausią kainų ir kokybės santykį</li>
    <li><strong>Greitas aptarnavimas</strong> - dauguma specialistų gali atvykti per 24-48 valandas</li>
    <li><strong>Klientų atsiliepimai</strong> - skaitykite tikrus klientų įvertinimus</li>
    <li><strong>Garantija</strong> - visi darbai atliekami su kokybės garantija</li>
</ul>

<h3>Kaip veikia {{ $categoryData->subcategory }} paslaugų užsakymas?</h3>
<ol>
    <li>Aprašykite savo poreikius ir nurodykite vietą</li>
    <li>Gaukite pasiūlymus nuo kelių specialistų</li>
    <li>Palyginkite kainas ir specialistų įvertinimus</li>
    <li>Pasirinkite tinkamiausią specialistą</li>
    <li>Susitarkite dėl laiko ir detalių</li>
    <li>Mėgaukitės kokybiškai atliktu darbu</li>
</ol>

<h3>{{ $categoryData->subcategory }} paslaugų privalumai</h3>
<p>Mūsų {{ $categoryData->subcategory }} specialistai pasižymi:</p>
<ul>
    <li>Profesionalumu ir patirtimi</li>
    <li>Moderniais įrankiais ir technologijomis</li>
    <li>Punktualumu ir patikimumu</li>
    <li>Skaidriomis kainomis be papildomų mokesčių</li>
</ul>

<p>Pradėkite šiandien ir raskite geriausią {{ $categoryData->subcategory }} specialistą savo rajone!</p>`
        };

        // Initialize TinyMCE
        tinymce.init({
            selector: '#content-editor',
            height: 400,
            menubar: false,
            plugins: [
                'advlist', 'autolink', 'lists', 'link', 'charmap', 'preview',
                'anchor', 'searchreplace', 'visualblocks', 'code', 'fullscreen',
                'insertdatetime', 'table', 'help', 'wordcount'
            ],
            toolbar: 'undo redo | blocks | bold italic | alignleft aligncenter alignright | ' +
                'bullist numlist outdent indent | link | removeformat | code | fullscreen | help',
            content_style: 'body { font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif; font-size: 14px; line-height: 1.6; }',
            setup: function (editor) {
                editor.on('change keyup', function () {
                    setTimeout(updatePreview, 100);
                });
            },
            init_instance_callback: function(editor) {
                updatePreview();
            }
        });

        // Load content templates
        function loadTemplate(type) {
            if (confirm('This will replace your current content. Continue?')) {
                tinymce.activeEditor.setContent(templates[type]);
                updatePreview();
            }
        }

        // Update preview function
        function updatePreview() {
            if (tinymce.activeEditor) {
                const content = tinymce.activeEditor.getContent();
                document.getElementById('content-preview').innerHTML = content || '<p class="text-gray-500 italic">No content yet...</p>';
            }
        }
    </script>
@endpush
