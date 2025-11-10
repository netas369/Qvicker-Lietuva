@extends('layouts.main')

@section('title', 'Admin - Categories Management')

@section('content')
    <div class="py-8 bg-gray-50 min-h-screen">
        <div class="container mx-auto px-4 sm:px-6 md:px-10 lg:px-20 xl:px-40 2xl:px-60">

            <!-- Header -->
            <div class="bg-white rounded-lg shadow-sm p-6 mb-6">
                <div class="flex justify-between items-center">
                    <div>
                        <h1 class="text-2xl font-bold text-gray-900">Categories Management</h1>
                        <p class="text-gray-600 mt-1">Add, delete subcategories</p>
                    </div>
                </div>
            </div>

            <!-- Success Message -->
            @if(session('success'))
                <div class="bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-lg mb-6">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Error Messages -->
            @if($errors->any())
                <div class="bg-red-50 border border-red-200 text-red-800 px-4 py-3 rounded-lg mb-6">
                    <ul class="list-disc list-inside">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Add New Category Form -->
            <div class="bg-white rounded-lg shadow-sm p-6 mb-6">
                <h2 class="text-xl font-semibold text-gray-900 mb-4">Add New Subcategory</h2>

                <form action="{{ route('admin.categories.store') }}" method="POST" class="space-y-4">
                    @csrf

                    <!-- Category Selection -->
                    <div>
                        <label for="category" class="block text-sm font-medium text-gray-700 mb-2">
                            Category <span class="text-red-500">*</span>
                        </label>
                        <select
                            id="category"
                            name="category"
                            required
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                        >
                            <option value="">Select a category</option>
                            <option value="Ezoterija" {{ old('category') == 'Ezoterija' ? 'selected' : '' }}>Ezoterija</option>
                            <option value="Fitnesas ir Sveikatingumas" {{ old('category') == 'Fitnesas ir Sveikatingumas' ? 'selected' : '' }}>Fitnesas ir Sveikatingumas</option>
                            <option value="Grožio Paslaugos" {{ old('category') == 'Grožio Paslaugos' ? 'selected' : '' }}>Grožio Paslaugos</option>
                            <option value="IT Pagalba" {{ old('category') == 'IT Pagalba' ? 'selected' : '' }}>IT Pagalba</option>
                            <option value="Kūrybinės Paslaugos" {{ old('category') == 'Kūrybinės Paslaugos' ? 'selected' : '' }}>Kūrybinės Paslaugos</option>
                            <option value="Meistrai ir remontas" {{ old('category') == 'Meistrai ir remontas' ? 'selected' : '' }}>Meistrai ir remontas</option>
                            <option value="Namų priežiūra ir valymas" {{ old('category') == 'Namų priežiūra ir valymas' ? 'selected' : '' }}>Namų priežiūra ir valymas</option>
                            <option value="Perkraustymo ir pakavimo paslaugos" {{ old('category') == 'Perkraustymo ir pakavimo paslaugos' ? 'selected' : '' }}>Perkraustymo ir pakavimo paslaugos</option>
                            <option value="Remontas" {{ old('category') == 'Remontas' ? 'selected' : '' }}>Remontas</option>
                            <option value="Renginių Pagalba" {{ old('category') == 'Renginių Pagalba' ? 'selected' : '' }}>Renginių Pagalba</option>
                            <option value="Sodininkystės ir lauko paslaugos" {{ old('category') == 'Sodininkystės ir lauko paslaugos' ? 'selected' : '' }}>Sodininkystės ir lauko paslaugos</option>
                            <option value="Statyba" {{ old('category') == 'Statyba' ? 'selected' : '' }}>Statyba</option>
                            <option value="Transporto paslaugos" {{ old('category') == 'Transporto paslaugos' ? 'selected' : '' }}>Transporto paslaugos</option>
                            <option value="Turizmas" {{ old('category') == 'Turizmas' ? 'selected' : '' }}>Turizmas</option>
                        </select>
                    </div>

                    <!-- Subcategory Input -->
                    <div>
                        <label for="subcategory" class="block text-sm font-medium text-gray-700 mb-2">
                            Subcategory <span class="text-red-500">*</span>
                        </label>
                        <input
                            type="text"
                            id="subcategory"
                            name="subcategory"
                            value="{{ old('subcategory') }}"
                            required
                            placeholder="Enter subcategory name"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                        >
                    </div>

                    <!-- URL Input -->
                    <div>
                        <label for="url" class="block text-sm font-medium text-gray-700 mb-2">
                            URL <span class="text-red-500">*</span>
                        </label>
                        <input
                            type="text"
                            id="url"
                            name="url"
                            value="{{ old('url') }}"
                            required
                            placeholder="e.g., ezoterija-astrologas"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                        >
                        <p class="text-sm text-gray-500 mt-1">Enter the URL slug for this subcategory</p>
                    </div>

                    <!-- Submit Button -->
                    <div class="flex justify-end">
                        <button
                            type="submit"
                            class="px-6 py-2 bg-blue-600 text-white font-medium rounded-lg hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 transition"
                        >
                            Add Subcategory
                        </button>
                    </div>
                </form>
            </div>

            <!-- Existing Categories List -->
            <div class="bg-white rounded-lg shadow-sm p-6">
                <h2 class="text-xl font-semibold text-gray-900 mb-4">Existing Subcategories</h2>

                @if($categories->isEmpty())
                    <p class="text-gray-500">No subcategories added yet.</p>
                @else
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead class="bg-gray-50 border-b border-gray-200">
                            <tr>
                                <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Category</th>
                                <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Subcategory</th>
                                <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">URL</th>
                                <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Created</th>
                            </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                            @foreach($categories as $cat)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-4 py-3 text-sm text-gray-900">{{ $cat->category }}</td>
                                    <td class="px-4 py-3 text-sm text-gray-900">{{ $cat->subcategory }}</td>
                                    <td class="px-4 py-3 text-sm text-gray-600">{{ $cat->url }}</td>
                                    <td class="px-4 py-3 text-sm text-gray-500">{{ $cat->created_at->format('Y-m-d') }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    @if($categories->hasPages())
                        <div class="mt-4">
                            {{ $categories->links() }}
                        </div>
                    @endif
                @endif
            </div>
        </div>
    </div>
@endsection
