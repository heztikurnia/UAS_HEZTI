<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}ㅤㅤㅤ{{ __("Welcome!") }} {{ Auth::user()->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form method="GET" action="{{ route('dashboard') }}" class="mb-6 flex space-x-2">
                        <input type="text" name="query" value="{{ old('query', $query ?? '') }}" placeholder="Search songs, albums, artists..." class="flex-grow border text-bg-dark border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500" />
                        <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 transition">Search</button>
                    </form>

                    @if(isset($query))
                        <h3 class="text-xl font-semibold mb-4">Search Results for "<span class="text-indigo-600">{{ $query }}</span>"</h3>

                        <div class="space-y-6">
                            <div>
                                <h4 class="text-lg font-semibold mb-2 border-b border-gray-300 pb-1">Songs</h4>
                                @if($songs->isEmpty())
                                    <p class="text-gray-500 italic">No songs found.</p>
                                @else
                                    <ul class="list-disc list-inside space-y-1 text-gray-800 dark:text-gray-200 max-h-48 overflow-y-auto">
                                        @foreach($songs as $song)
                                            <li class="hover:text-indigo-600 transition cursor-pointer">
                                                {{ $song->title }} - Status: <span class="font-semibold">{{ ($song->status == 0) ? 'Valid' : (($song->status == 1) ? 'Invalid' : 'Not-validated') }}</span>
                                            </li>
                                        @endforeach
                                    </ul>
                                @endif
                            </div>

                            <div>
                                <h4 class="text-lg font-semibold mb-2 border-b border-gray-300 pb-1">Albums</h4>
                                @if($albums->isEmpty())
                                    <p class="text-gray-500 italic">No albums found.</p>
                                @else
                                    <ul class="list-disc list-inside space-y-1 text-gray-800 dark:text-gray-200 max-h-48 overflow-y-auto">
                                        @foreach($albums as $album)
                                            <li class="hover:text-indigo-600 transition cursor-pointer">
                                                {{ $album->title }} - Status: <span class="font-semibold">{{ ($album->status == 0) ? 'Active' : (($album->status == 1) ? 'Inactive' : 'Not-actived') }}</span>
                                            </li>
                                        @endforeach
                                    </ul>
                                @endif
                            </div>

                            <div>
                                <h4 class="text-lg font-semibold mb-2 border-b border-gray-300 pb-1">Artists</h4>
                                @if($artists->isEmpty())
                                    <p class="text-gray-500 italic">No artists found.</p>
                                @else
                                    <ul class="list-disc list-inside space-y-1 text-gray-800 dark:text-gray-200 max-h-48 overflow-y-auto">
                                        @foreach($artists as $artist)
                                            <li class="hover:text-indigo-600 transition cursor-pointer">
                                                {{ $artist->name }} - Status: <span class="font-semibold">{{ ($artist->status == 0) ? 'Verified' : (($artist->status == 1) ? 'Unverified' : 'Not-registered') }}</span>
                                            </li>
                                        @endforeach
                                    </ul>
                                @endif
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
