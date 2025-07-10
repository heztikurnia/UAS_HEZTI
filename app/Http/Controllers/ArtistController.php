<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Album;
use App\Models\Artist;

class ArtistController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Fetch all artists with their associated albums
        $artists = Artist::with('albums')
            ->where('data_state', 0) // Only active artists
            ->paginate(10); // Paginate results

        // Return the view with the list of artists
        return view('artists.index', compact('artists'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Show the form to create a new artist
        return view('artists.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the request data
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'nullable|string', // 0 for valid, 1 for non-valid
        ]);

        // Create a new artist
        Artist::create($request->all());

        // Redirect to the artists index with a success message
        return redirect()->route('artists.index')->with('success', 'Artist created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Find the artist by ID
        $artist = Artist::with('albums')->findOrFail($id);

        // Return the view with the artist details
        return view('artists.show', compact('artist'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // Find the artist by ID
        $artist = Artist::findOrFail($id);

        // Show the form to edit the artist
        return view('artists.edit', compact('artist'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validate the request data
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'nullable|in:0,1,2', // 0 for valid, 1 for non-valid
        ]);

        // Find the artist by ID and update it
        $artist = Artist::findOrFail($id);
        $artist->update($request->all());

        // Redirect to the artists index with a success message
        return redirect()->route('artists.index')->with('success', 'Artist updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Find the artist by ID
        $artist = Artist::findOrFail($id);

        // Soft delete the artist (set data_state to 1)
        $artist->data_state = 1;
        $artist->save();

        // Redirect to the artists index with a success message
        return redirect()->route('artists.index')->with('success', 'Artist deleted successfully.');
    }
}
