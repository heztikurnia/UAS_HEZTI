<x-guest-layout>
    <form method="post" action="{{ route('artists.update', $artist->id) }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $artist->name)" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div>
            <x-input-label for="description" :value="__('Description')" />
            <x-text-input id="description" name="description" type="text" class="mt-1 block w-full" :value="old('description', $artist->description)" required autocomplete="description" />
            <x-input-error class="mt-2" :messages="$errors->get('description')" />
        </div>

        <div>
            <x-input-label for="status" :value="__('Status')" />
            <select id="status" name="status" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                <option value="0" {{ old('status', $artist->status) == 0 ? 'selected' : '' }}>{{ __('Verified') }}</option>
                <option value="1" {{ old('status', $artist->status) == 1 ? 'selected' : '' }}>{{ __('Unverified') }}</option>
                <option value="2" {{ old('status', $artist->status) == 2 ? 'selected' : '' }}>{{ __('Unverified') }}</option>
            </select>
            <x-input-error class="mt-2" :messages="$errors->get('status')" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('artists.index') }}">
                {{ __('Back') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Save') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
