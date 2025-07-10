<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Albums') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <!-- Content for artists index page goes here -->
                    @if (session('success'))
                        <div class="bg-green-100 text-green-800 p-4 rounded mb-4">
                            {{ session('success') }}
                        </div>
                    @endif
                    <x-secondary-button>
                        <a href="{{ route('albums.create') }}" class="px-6 py-3 dark:border-blue-700 text-left text-xs font-medium text-blue-500 uppercase tracking-wider w-1/4">Add New Album</a>
                    </x-secondary-button>
                    <div class="overflow-x-auto">
                        <table class="min-w-full w-full bg-white dark:bg-gray-800 shadow-md rounded-lg overflow-hidden table-auto">
                            <thead>
                                <tr>
                                    <th class="px-6 py-3 border-b border-gray-200 dark:border-gray-700 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-1/4">Title</th>
                                    <th class="px-6 py-3 border-b border-gray-200 dark:border-gray-700 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-1/4">Artists</th>
                                    <th class="px-6 py-3 border-b border-gray-200 dark:border-gray-700 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-1/4">Release Date</th>
                                    <th class="px-6 py-3 border-b border-gray-200 dark:border-gray-700 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-2/4">Genre</th>
                                    <th class="px-6 py-3 border-b border-gray-200 dark:border-gray-700 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-2/4">Description</th>
                                    <th class="px-6 py-3 border-b border-gray-200 dark:border-gray-700 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-2/4">Status</th>
                                    <th class="px-6 py-3 border-b border-gray-200 dark:border-gray-700 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-1/4">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($albums as $album)
                                    <tr class="hover:bg-gray-100 dark:hover:bg-gray-700">
                                        <td class="px-6 py-4 border-b border-gray-200 dark:border-gray-700 w-1/4 align-top">{{ $album->title }}</td>
                                        <td class="px-6 py-4 border-b border-gray-200 dark:border-gray-700 w-1/4 align-top">
                                            {{ $album->artist ? $album->artist->name : '' }}
                                        </td>
                                        <td class="px-6 py-4 border-b border-gray-200 dark:border-gray-700 w-1/4 align-top">{{ $album->release_date}}</td>
                                        <td class="px-6 py-4 border-b border-gray-200 dark:border-gray-700 w-1/4 align-top">{{ $album->genre}}</td>
                                        <td class="px-6 py-4 border-b border-gray-200 dark:border-gray-700 w-2/4 align-top">{{ $album->description }}</td>
                                        <td class="px-6 py-4 border-b border-gray-200 dark:border-gray-700 w-2/4 align-top">
                                            @if ($album->status == 0)
                                                <span class="text-green-600 dark:text-green-400">{{ __('Active') }}</span>
                                            @elseif ($album->status == 1)
                                                <span class="text-red-600 dark:text-red-400">{{ __('Inactive') }}</span>
                                            @else
                                                <span class="text-gray-600 dark:text-gray-400">{{ __('Not Active') }}</span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 border-b border-gray-200 dark:border-gray-700 w-1/4 align-top">
                                            <div class="flex items-center space-x-4">
                                                <x-secondary-button>
                                                    <a class="px-2 py-1 dark:border-white-700 text-left text-xs font-medium text-white-500 uppercase tracking-wider w-1/4" href="{{ route('albums.show', $album->id) }}">
                                                        {{ __('View') }}
                                                    </a>
                                                </x-secondary-button>ㅤ
                                                <x-secondary-button>
                                                    <a  class="px-2 py-1 dark:border-white-700 text-left text-xs font-medium text-white-500 uppercase tracking-wider w-1/4" href="{{ route('albums.edit', $album->id) }}">
                                                        {{ __('Edit') }}
                                                    </a>
                                                </x-secondary-button>ㅤ
                                                <form action="{{ route('albums.destroy', $album->id) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this album?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <x-danger-button>
                                                        <p  class="px-2 py-1 dark:border-white-700 text-left text-xs font-medium text-white-500 uppercase tracking-wider w-1/4">{{ __('Delete') }}</p>
                                                    </x-danger-button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="px-6 py-4 text-center text-gray-500 dark:text-gray-400">
                                            No albums found.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

                
</x-app-layout>