<div>

    <div class="container mx-auto px-4 py-8">
        <div class="max-w-2xl mx-auto bg-white rounded-lg shadow-md p-6">

            @if (session()->has('message'))
                <div
                    id="session-message"
                    class="bg-gray-400 text-primary-light p-3 rounded shadow mb-4 font-medium"
                >
                    {{ session('message') }}
                </div>
                <script>
                    setTimeout(() => {
                        const msg = document.getElementById('session-message');
                        if (msg) {
                            msg.remove(); // Hides after 3 seconds
                        }
                    }, 3000);
                </script>
            @endif


            <h1 class="text-2xl font-bold mb-6 text-primary">Mano Profilis</h1>

            <form wire:submit.prevent="update" class="space-y-6">

                <!-- Grid Container -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- First Name -->
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700">Vardas</label>
                        <input type="text" id="name" name="name" wire:model="name"
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm bg-gray-100 cursor-not-allowed focus:border-gray-300 focus:ring-0 @error('name') border-red-500 @enderror"
                               readonly>
                        @error('name')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Last Name -->
                    <div>
                        <label for="lastname" class="block text-sm font-medium text-gray-700">Pavardė</label>
                        <input readonly type="text" id="lastname" name="lastname" wire:model="lastname"
                               class="bg-gray-100 mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 @error('lastname') border-red-500 @enderror">
                        @error('lastname')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Email (disabled) -->
                    <div class="md:col-span-2">
                        <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                        <input type="email" id="email" name="email" wire:model="email" readonly
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm bg-gray-100 cursor-not-allowed">
                    </div>

                    <!-- Birthday -->
                    <div>
                        <label for="birthday" class="block text-sm font-medium text-gray-700">Gimimo Diena</label>
                        <input readonly type="date" id="birthday" name="birthday" wire:model="birthday"
                               class="mt-1 block w-full rounded-md bg-gray-100 border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 @error('birthday') border-red-500 @enderror">
                        @error('birthday')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Role -->
                    <div>
                        <label for="role" class="block text-sm font-medium text-gray-700">Rolė</label>
                        <select id="role" name="role" disabled
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 @error('role') border-red-500 @enderror">
                            <option value="provider" {{ $user->role === 'provider' ? 'selected' : '' }}>Provider</option>
                            <option value="seeker" {{ $user->role === 'seeker' ? 'selected' : '' }}>Seeker</option>
                        </select>
                        @error('role')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Address -->
                    <div class="md:col-span-2">
                        <label for="address" class="block text-sm font-medium text-gray-700">Adresas</label>
                        <input type="text" id="address" name="address" wire:model="address""
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 @error('address') border-red-500 @enderror">
                        @error('address')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- City -->
                    <div class="md:col-span-2">
                        <label for="city" class="block text-sm font-medium text-gray-700">Miestas</label>
                        <input type="text" id="city" name="city" wire:model="city"
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 @error('city') border-red-500 @enderror">
                        @error('city')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Subcategories -->
                    <div class="md:col-span-2">
                        <label for="subcategories" class="block text-sm font-medium text-gray-700">Darbo Kategorijos</label>
                        <select id="subcategories" name="subcategories[]" multiple
                                class="mt-1 block w-full rounded-md  shadow-sm focus:border-indigo-500 focus:ring-indigo-500 @error('subcategories') border-red-500 @enderror">
                            @foreach (json_decode($user->subcategories) as $subcategory) <!-- Decode user's subcategories -->
                            <option value="{{ $subcategory }}" selected>
                                {{ $subcategory }}
                            </option>
                            @endforeach
                        </select>
                        @error('subcategories')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="flex justify-end mt-8">
                    <button type="submit"
                            class="inline-flex items-center px-4 py-2 bg-primary border border-transparent rounded-md font-semibold text-white hover:bg-primary-dark focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors duration-200">
                        Update Profile
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
