<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Album;

class AlbumController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Fetch all albums with their associated artists
        $albums = Album::with('artist')
            ->where('data_state', 0) // Only active albums
            ->paginate(10); // Paginate results

        // Return the view with the list of albums
        return view('albums.index', compact('albums'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Show the form to create a new album
        return view('albums.create');
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
            'release_date' => 'nullable|date',
            'genre' => 'nullable|string|max:100',
            'status' => 'nullable|string', // 0 for valid, 1 for non-valid
            'description' => 'nullable|string',
        ]);

        // Create a new album
        Album::create($request->all());

        // Redirect to the albums index with a success message
        return redirect()->route('albums.index')->with('success', 'Album created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Find the album by ID
        $album = Album::with('artist')->findOrFail($id);

        // Return the view with the album details
        return view('albums.show', compact('album'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // Find the album by ID
        $album = Album::findOrFail($id);

        // Get all artists for the select dropdown
        $artists = \App\Models\Artist::all();

        // Show the form to edit the album
        return view('albums.edit', compact('album', 'artists'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validate the request data
        $request->validate([
            'title' => 'required|string|max:255',
            'artist_id' => 'required|exists:artists,id',
            'release_date' => 'nullable|date',
            'genre' => 'nullable|string|max:100',
            'status' => 'nullable|in:0,1,2', // 0 for valid, 1 for non-valid
            'description' => 'nullable|string',
        ]);

        // Find the album by ID and update it
        $album = Album::findOrFail($id);
        $album->update($request->all());

        // Redirect to the albums index with a success message
        return redirect()->route('albums.index')->with('success', 'Album updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Find the album by ID
        $album = Album::findOrFail($id);

        // Soft delete the album (set data_state to 1)
        $album->data_state = 1;
        $album->save();

        // Redirect to the albums index with a success message
        return redirect()->route('albums.index')->with('success', 'Album deleted successfully.');
    }
}
