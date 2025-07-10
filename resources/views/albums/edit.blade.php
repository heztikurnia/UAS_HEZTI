<x-guest-layout>
    <form method="post" action="{{ route('albums.update', $album->id) }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div>
            <x-input-label for="title" :value="__('Title')" />
            <x-text-input id="title" name="title" type="text" class="mt-1 block w-full" :value="old('title', $album->title)" required autofocus autocomplete="title" />
            <x-input-error class="mt-2" :messages="$errors->get('title')" />
        </div>

        <div>
            <x-input-label for="artist_id" :value="__('Artist')" />
            <select id="artist_id" name="artist_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                @foreach($artists as $artist)
                    <option value="{{ $artist->id }}" {{ old('artist_id', $album->artist_id) == $artist->id ? 'selected' : '' }}>
                        {{ $artist->name }}
                    </option>
                @endforeach
            </select>
            <x-input-error class="mt-2" :messages="$errors->get('artist_id')" />
        </div>

        <div>
            <x-input-label for="release_date" :value="__('Release Date')" />
            <x-text-input id="release_date" name="release_date" type="date" class="mt-1 block w-full" :value="old('release_date', $album->release_date)" required />
            <x-input-error class="mt-2" :messages="$errors->get('release_date')" />
        </div>

        <div>
            <x-input-label for="genre" :value="__('Genre')" />
            <x-text-input id="genre" name="genre" type="text" class="mt-1 block w-full" :value="old('genre', $album->genre)" required />
            <x-input-error class="mt-2" :messages="$errors->get('genre')" />
        </div>

        <div>
            <x-input-label for="description" :value="__('Description')" />
            <x-text-input id="description" name="description" type="text" class="mt-1 block w-full" :value="old('description', $album->description)" required />
            <x-input-error class="mt-2" :messages="$errors->get('description')" />
        </div>

        <div>
            <x-input-label for="status" :value="__('Status')" />
            <select id="status" name="status" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                <option value="0" {{ old('status', $album->status) == 0 ? 'selected' : '' }}>{{ __('Active') }}</option>
                <option value="1" {{ old('status', $album->status) == 1 ? 'selected' : '' }}>{{ __('Inactive') }}</option>
                <option value="2" {{ old('status', $album->status) == 2 ? 'selected' : '' }}>{{ __('Not Active') }}</option>
            </select>
            <x-input-error class="mt-2" :messages="$errors->get('status')" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('albums.index') }}">
                {{ __('Back') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Save') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
