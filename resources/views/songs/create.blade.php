<x-guest-layout>
    <form method="POST" action="{{ route('songs.store') }}" class="mt-6 space-y-6">
        @csrf

        <div>
            <x-input-label for="title" :value="__('Title')" />
            <x-text-input id="title" name="title" type="text" class="mt-1 block w-full" :value="old('title')" required autofocus autocomplete="title" />
            <x-input-error class="mt-2" :messages="$errors->get('title')" />
        </div>

        <div>
            <x-input-label for="artist_id" :value="__('Artist')" />
            <select id="artist_id" name="artist_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                <option value="">{{ __('-- Select Artist --') }}</option>
                @foreach($artists as $artist)
                    <option value="{{ $artist->id }}" {{ old('artist_id') == $artist->id ? 'selected' : '' }}>
                        {{ $artist->name }}
                    </option>
                @endforeach
            </select>
            <x-input-error class="mt-2" :messages="$errors->get('artist_id')" />
        </div>

        <div>
            <x-input-label for="album_id" :value="__('Album')" />
            <select id="album_id" name="album_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                <option value="">{{ __('-- None --') }}</option>
                @foreach($albums as $album)
                    <option value="{{ $album->id }}" {{ old('album_id') == $album->id ? 'selected' : '' }}>
                        {{ $album->title }}
                    </option>
                @endforeach
            </select>
            <x-input-error class="mt-2" :messages="$errors->get('album_id')" />
        </div>

        <div>
            <x-input-label for="duration" :value="__('Duration')" />
            <x-text-input id="duration" name="duration" type="text" min="1" class="mt-1 block w-full" :value="old('duration')" required />
            <x-input-error class="mt-2" :messages="$errors->get('duration')" />
        </div>

        <div>
            <x-input-label for="genre" :value="__('Genre')" />
            <x-text-input id="genre" name="genre" type="text" class="mt-1 block w-full" :value="old('genre')" />
            <x-input-error class="mt-2" :messages="$errors->get('genre')" />
        </div>

        <div>
            <x-input-label for="description" :value="__('Description')" />
            <x-text-input id="description" name="description" type="text" class="mt-1 block w-full" :value="old('description')" />
            <x-input-error class="mt-2" :messages="$errors->get('description')" />
        </div>

        {{-- <div>
            <x-input-label for="status" :value="__('Status')" />
            <select id="status" name="status" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                <option value="0" {{ old('status') == 0 ? 'selected' : '' }}>{{ __('Valid') }}</option>
                <option value="1" {{ old('status') == 1 ? 'selected' : '' }}>{{ __('Non-valid') }}</option>
            </select>
            <x-input-error class="mt-2" :messages="$errors->get('status')" />
        </div> --}}

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('songs.index') }}">
                {{ __('Back') }}
            </a>
            <x-primary-button class="ms-4">
                {{ __('Save') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
