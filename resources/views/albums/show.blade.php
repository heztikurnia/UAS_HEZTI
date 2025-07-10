<x-guest-layout>
    <form method="post" action="{{ route('albums.show', $album->id) }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div>
            <x-input-label for="title" :value="__('Title')" />
            <x-text-input id="title" name="title" type="text" class="mt-1 block w-full" :value="old('title', $album->title)" readonly/>
            <x-input-error class="mt-2" :messages="$errors->get('title')" />
        </div>

        <div>
            <x-input-label for="artist" :value="__('Artist')" />
            <x-text-input id="artist" name="artist" type="text" class="mt-1 block w-full" :value="old('artist', $album->artist ? $album->artist->name : '')" readonly/>
            <x-input-error class="mt-2" :messages="$errors->get('artist')" />
        </div>

        <div>
            <x-input-label for="release_date" :value="__('Release Date')" />
            <x-text-input id="release_date" name="release_date" type="date" class="mt-1 block w-full" :value="old('release_date', $album->release_date)" readonly/>
            <x-input-error class="mt-2" :messages="$errors->get('release_date')" />
        </div>

        <div>
            <x-input-label for="genre" :value="__('Genre')" />
            <x-text-input id="genre" name="genre" type="text" class="mt-1 block w-full" :value="old('genre', $album->genre)" readonly/>
            <x-input-error class="mt-2" :messages="$errors->get('genre')" />
        </div>

        <div>
            <x-input-label for="description" :value="__('Description')" />
            <x-text-input id="description" name="description" type="text" class="mt-1 block w-full" :value="old('description', $album->description)" readonly/>
            <x-input-error class="mt-2" :messages="$errors->get('description')" />
        </div>

        <div>
            <x-input-label for="status" :value="__('Status')" />
            <x-text-input id="status" name="status" type="text" class="mt-1 block w-full" :value="old('status', $album->status == 0 ? 'Active' : 'Inactive')" readonly/>
            <x-input-error class="mt-2" :messages="$errors->get('status')" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('albums.index') }}">
                {{ __('Back') }}
            </a>
        </div>
    </form>
</x-guest-layout>
