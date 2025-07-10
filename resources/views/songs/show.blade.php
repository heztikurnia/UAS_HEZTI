<x-guest-layout>
    <div class="mt-6 space-y-6">
        <div>
            <x-input-label for="title" :value="__('Title')" />
            <x-text-input id="title" name="title" type="text" class="mt-1 block w-full" :value="$song->title" readonly/>
        </div>

        <div>
            <x-input-label for="artist" :value="__('Artist')" />
            <x-text-input id="artist" name="artist" type="text" class="mt-1 block w-full" :value="$song->artist ? $song->artist->name : ''" readonly/>
        </div>

        <div>
            <x-input-label for="album" :value="__('Album')" />
            <x-text-input id="album" name="album" type="text" class="mt-1 block w-full" :value="$song->album ? $song->album->title : ''" readonly/>
        </div>

        <div>
            <x-input-label for="duration" :value="__('Duration (seconds)')" />
            <x-text-input id="duration" name="duration" type="text" class="mt-1 block w-full" :value="$song->duration" readonly/>
        </div>

        <div>
            <x-input-label for="genre" :value="__('Genre')" />
            <x-text-input id="genre" name="genre" type="text" class="mt-1 block w-full" :value="$song->genre" readonly/>
        </div>

        <div>
            <x-input-label for="description" :value="__('Description')" />
            <x-text-input id="description" name="description" type="text" class="mt-1 block w-full" :value="$song->description" readonly/>
        </div>

        <div>
            <x-input-label for="status" :value="__('Status')" />
            <x-text-input id="status" name="status" type="text" class="mt-1 block w-full" :value="$song->status == 0 ? 'Valid' : 'Non-valid'" readonly/>
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('songs.index') }}">
                {{ __('Back') }}
            </a>
        </div>
    </div>
</x-guest-layout>
