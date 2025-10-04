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
        .image-preview-container {
            position: relative;
            display: inline-block;
        }
        .remove-image-btn {
            position: absolute;
            top: 0.5rem;
            right: 0.5rem;
            background: rgba(239, 68, 68, 0.9);
            color: white;
            border: none;
            border-radius: 50%;
            width: 32px;
            height: 32px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: background 0.2s;
        }
        .remove-image-btn:hover {
            background: rgba(220, 38, 38, 1);
        }
        .faq-item {
            transition: all 0.2s ease;
        }
        .faq-item:hover {
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .faq-item.dragging {
            opacity: 0.5;
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
            <form method="POST" action="{{ route('admin.service-pages.update', $categoryData->url) }}" enctype="multipart/form-data">
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

                        <!-- Featured Image Upload -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Featured Image</label>

                            @if(isset($servicePage) && !empty($servicePage->image_path))
                                <div class="mb-4 image-preview-container">
                                    <img src="{{ asset('storage/' . $servicePage->image_path) }}"
                                         alt="Current image"
                                         class="max-w-md rounded-lg border border-gray-300"
                                         id="current-image">
                                    <button type="button"
                                            onclick="removeImage()"
                                            class="remove-image-btn"
                                            title="Remove image">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                        </svg>
                                    </button>
                                </div>
                                <input type="hidden" name="remove_image" id="remove-image-input" value="0">
                            @endif

                            <div class="mt-2">
                                <input type="file"
                                       name="featured_image"
                                       id="featured-image-input"
                                       accept="image/jpeg,image/png,image/jpg,image/webp"
                                       class="block w-full text-sm text-gray-500
                                              file:mr-4 file:py-2 file:px-4
                                              file:rounded-lg file:border-0
                                              file:text-sm file:font-semibold
                                              file:bg-blue-50 file:text-blue-700
                                              hover:file:bg-blue-100
                                              cursor-pointer"
                                       onchange="previewImage(event)">
                                <p class="text-sm text-gray-500 mt-2">
                                    Recommended: 1200x630px or larger. Max size: 10MB. Formats: JPG, PNG, WebP
                                </p>
                            </div>

                            <!-- Image Preview for new upload -->
                            <div id="new-image-preview" class="mt-4 hidden">
                                <p class="text-sm font-medium text-gray-700 mb-2">New Image Preview:</p>
                                <img id="preview-img" src="" alt="Preview" class="max-w-md rounded-lg border border-gray-300">
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

                <!-- FAQ Manager Section -->
                <div class="bg-white rounded-lg shadow-sm mb-6">
                    <div class="p-6 border-b border-gray-200">
                        <div class="flex items-center justify-between">
                            <div>
                                <h2 class="text-xl font-semibold text-gray-900">FAQ Section</h2>
                                <p class="text-sm text-gray-600 mt-1">
                                    Add frequently asked questions to improve SEO and user experience
                                </p>
                            </div>
                            <button type="button" onclick="addFAQ()"
                                    class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition flex items-center">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                </svg>
                                Add FAQ
                            </button>
                        </div>
                    </div>

                    <div class="p-6">
                        <div id="faq-container" class="space-y-4">
                            <!-- FAQ items will be added here dynamically -->
                        </div>

                        <!-- Hidden input to store FAQ data as JSON -->
                        <input type="hidden" name="faq" id="faq-data" value="{{ old('faq', $servicePage->faq ?? '[]') }}">

                        <!-- Empty state -->
                        <div id="faq-empty-state" class="text-center py-8 text-gray-500">
                            <svg class="w-16 h-16 mx-auto mb-4 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <p>No FAQs added yet. Click "Add FAQ" to create your first question.</p>
                        </div>
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

    <!-- FAQ Item Template (hidden) -->
    <template id="faq-item-template">
        <div class="faq-item bg-gray-50 border border-gray-200 rounded-lg p-4" data-index="" draggable="true">
            <div class="flex items-start justify-between mb-3">
                <div class="flex items-center">
                    <div class="cursor-move mr-3 text-gray-400 hover:text-gray-600" title="Drag to reorder">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8h16M4 16h16"></path>
                        </svg>
                    </div>
                    <span class="font-semibold text-gray-700">FAQ #<span class="faq-number"></span></span>
                </div>
                <button type="button" onclick="removeFAQ(this)"
                        class="text-red-600 hover:text-red-800 transition" title="Remove FAQ">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                    </svg>
                </button>
            </div>

            <div class="space-y-3">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Question *</label>
                    <input type="text"
                           class="faq-question w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                           placeholder="e.g., Kiek kainuoja generalinio valymo paslaugos?">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Answer *</label>
                    <textarea
                        class="faq-answer w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                        rows="3"
                        placeholder="Provide a detailed answer..."></textarea>
                </div>
            </div>
        </div>
    </template>
@endsection

@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/6.8.3/tinymce.min.js"></script>
    <script>
        let faqData = [];

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

        // Initialize on page load
        document.addEventListener('DOMContentLoaded', function() {
            initializeFAQ();
            initializeDragAndDrop();
        });

        // FAQ Functions
        function initializeFAQ() {
            const faqInput = document.getElementById('faq-data');
            try {
                faqData = JSON.parse(faqInput.value || '[]');
            } catch (e) {
                console.error('Error parsing FAQ data:', e);
                faqData = [];
            }

            if (faqData.length > 0) {
                faqData.forEach((faq, index) => {
                    renderFAQ(faq, index);
                });
            }
            updateEmptyState();
        }

        function addFAQ() {
            const newFaq = { question: '', answer: '' };
            faqData.push(newFaq);
            renderFAQ(newFaq, faqData.length - 1);
            updateEmptyState();
            updateFAQData();

            setTimeout(() => {
                const container = document.getElementById('faq-container');
                const lastItem = container.lastElementChild;
                lastItem.scrollIntoView({ behavior: 'smooth', block: 'center' });
                lastItem.querySelector('.faq-question').focus();
            }, 100);
        }

        function renderFAQ(faq, index) {
            const template = document.getElementById('faq-item-template');
            const clone = template.content.cloneNode(true);
            const container = document.getElementById('faq-container');

            const faqDiv = clone.querySelector('.faq-item');
            faqDiv.setAttribute('data-index', index);
            clone.querySelector('.faq-number').textContent = index + 1;

            const questionInput = clone.querySelector('.faq-question');
            const answerInput = clone.querySelector('.faq-answer');

            questionInput.value = faq.question || '';
            answerInput.value = faq.answer || '';

            questionInput.addEventListener('input', function() {
                updateFAQItem(index, 'question', this.value);
            });

            answerInput.addEventListener('input', function() {
                updateFAQItem(index, 'answer', this.value);
            });

            container.appendChild(clone);
        }

        function removeFAQ(button) {
            if (!confirm('Are you sure you want to remove this FAQ?')) return;

            const faqItem = button.closest('.faq-item');
            const index = parseInt(faqItem.getAttribute('data-index'));

            faqData.splice(index, 1);
            faqItem.remove();

            rerenderAllFAQs();
            updateEmptyState();
            updateFAQData();
        }

        function updateFAQItem(index, field, value) {
            if (faqData[index]) {
                faqData[index][field] = value;
                updateFAQData();
            }
        }

        function updateFAQData() {
            document.getElementById('faq-data').value = JSON.stringify(faqData);
        }

        function rerenderAllFAQs() {
            const container = document.getElementById('faq-container');
            container.innerHTML = '';
            faqData.forEach((faq, index) => renderFAQ(faq, index));
        }

        function updateEmptyState() {
            const emptyState = document.getElementById('faq-empty-state');
            emptyState.classList.toggle('hidden', faqData.length > 0);
        }

        // Drag and Drop
        function initializeDragAndDrop() {
            const container = document.getElementById('faq-container');
            let draggedElement = null;

            container.addEventListener('dragstart', function(e) {
                if (e.target.classList.contains('faq-item')) {
                    draggedElement = e.target;
                    e.target.classList.add('dragging');
                }
            });

            container.addEventListener('dragend', function(e) {
                if (e.target.classList.contains('faq-item')) {
                    e.target.classList.remove('dragging');
                }
            });

            container.addEventListener('dragover', function(e) {
                e.preventDefault();
                const afterElement = getDragAfterElement(container, e.clientY);
                if (afterElement == null) {
                    container.appendChild(draggedElement);
                } else {
                    container.insertBefore(draggedElement, afterElement);
                }
            });

            container.addEventListener('drop', function(e) {
                e.preventDefault();
                updateFAQOrderFromDOM();
            });
        }

        function getDragAfterElement(container, y) {
            const draggableElements = [...container.querySelectorAll('.faq-item:not(.dragging)')];
            return draggableElements.reduce((closest, child) => {
                const box = child.getBoundingClientRect();
                const offset = y - box.top - box.height / 2;
                if (offset < 0 && offset > closest.offset) {
                    return { offset: offset, element: child };
                }
                return closest;
            }, { offset: Number.NEGATIVE_INFINITY }).element;
        }

        function updateFAQOrderFromDOM() {
            const items = document.querySelectorAll('.faq-item');
            const newOrder = [];
            items.forEach((item, newIndex) => {
                const oldIndex = parseInt(item.getAttribute('data-index'));
                newOrder.push(faqData[oldIndex]);
                item.setAttribute('data-index', newIndex);
                item.querySelector('.faq-number').textContent = newIndex + 1;
            });
            faqData = newOrder;
            updateFAQData();
        }

        // Image Functions
        function previewImage(event) {
            const file = event.target.files[0];
            if (!file) return;

            if (file.size > 10 * 1024 * 1024) {
                alert('File size must be less than 10MB');
                event.target.value = '';
                return;
            }

            const allowedTypes = ['image/jpeg', 'image/jpg', 'image/png', 'image/webp'];
            if (!allowedTypes.includes(file.type)) {
                alert('Only JPG, PNG, and WebP images are allowed');
                event.target.value = '';
                return;
            }

            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('preview-img').src = e.target.result;
                document.getElementById('new-image-preview').classList.remove('hidden');
            };
            reader.readAsDataURL(file);
        }

        function removeImage() {
            if (confirm('Are you sure you want to remove this image?')) {
                document.getElementById('remove-image-input').value = '1';
                document.getElementById('current-image').closest('.image-preview-container').style.display = 'none';
            }
        }

        // TinyMCE
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

        // Template Functions
        function loadTemplate(type) {
            if (confirm('This will replace your current content. Continue?')) {
                tinymce.activeEditor.setContent(templates[type]);
                updatePreview();
            }
        }

        // Preview Function
        function updatePreview() {
            if (tinymce.activeEditor) {
                const content = tinymce.activeEditor.getContent();
                document.getElementById('content-preview').innerHTML = content || '<p class="text-gray-500 italic">No content yet...</p>';
            }
        }

        // Form Validation
        document.querySelector('form').addEventListener('submit', function(e) {
            const emptyFaqs = faqData.filter(faq => !faq.question.trim() || !faq.answer.trim());
            if (emptyFaqs.length > 0) {
                e.preventDefault();
                alert('Please fill in all FAQ questions and answers, or remove empty FAQs.');
                return false;
            }
        });
    </script>
@endpush
