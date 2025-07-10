<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Song;
use App\Models\Artist;
use App\Models\Album;

class SongController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Fetch all songs with their associated artist and album
        $songs = Song::with(['artist', 'album'])
            ->where('data_state', 0) // Only active songs
            ->paginate(10); // Paginate results

        return view('songs.index', compact('songs'));
    }

    /**
     * Show the form for creating a new resource.
     */

    public function create()
    {
        // Get artists and albums for select inputs
        $artists = Artist::all();
        $albums = Album::all();

        // Show the form to create a new song with artists and albums
        return view('songs.create', compact('artists', 'albums'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the request data
        $request->validate([
            'title' => 'required|string|max:255',
            'artist_id' => 'required|exists:artists,id',
            'album_id' => 'nullable|exists:albums,id',
            'duration' => 'required|string|min:1',
            'genre' => 'nullable|string|max:100',
            'status' => 'nullable|string',
            'description' => 'nullable|string',
        ]);

        // Create a new song
        Song::create($request->all());

        // Redirect to the songs index with a success message
        return redirect()->route('songs.index')->with('success', 'Song created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Find the song by ID
        $song = Song::with(['artist', 'album'])->findOrFail($id);

        // Return the view with the song details
        return view('songs.show', compact('song'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $artists = Artist::all();
        $albums = Album::all();
        // Find the song by ID
        $song = Song::findOrFail($id);
        return view('songs.edit', compact('song', 'artists', 'albums'));
        // Get artists and albums for select input
        
    /**
     * Update the specified resource in storage.vavar_names: var_names: var_names: r_names: 
     */
    }
    public function update(Request $request, string $id)
    {
        // Validate the request data
        $request->validate([
            'title' => 'required|string|max:255',
            'artist_id' => 'required|exists:artists,id',
            'album_id' => 'nullable|exists:albums,id',
            'duration' => 'required|string|min:1',
            'genre' => 'nullable|string|max:100',
            'status' => 'nullable|in:0,1,2', // 0 for valid, 1 for non-valid
            'description' => 'nullable|string',
        ]);

        // Find the song and update it
        $song = Song::findOrFail($id);
        $song->update($request->all());

        // Redirect to the songs index with a success message
        return redirect()->route('songs.index')->with('success', 'Song updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Find the song by ID
        $song = Song::findOrFail($id);

        // Soft delete the song (set data_state to 1)
        $song->data_state = 1;
        $song->save();

        // Redirect to the songs index with a success message
        return redirect()->route('songs.index')->with('success', 'Song deleted successfully.');
    }
}
