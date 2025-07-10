<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Song;
use App\Models\Album;
use App\Models\Artist;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('query');

        $songs = collect();
        $albums = collect();
        $artists = collect();

        if ($query) {
            // Map status keywords to status values
            $statusMap = [
                'active' => 0,
                'valid' => 0,
                'verified' => 0,
                'unverified' => 1,
                'inactive' => 1,
                'invalid' => 1,
            ];

            $statusValue = null;
            foreach ($statusMap as $key => $value) {
                if (stripos($query, $key) !== false) {
                    $statusValue = $value;
                    break;
                }
            }

            $songs = Song::where(function($q) use ($query, $statusValue) {
                    $q->where('title', 'like', "%{$query}%")
                      ->orWhere('genre', 'like', "%{$query}%")
                      ->orWhere('description', 'like', "%{$query}%");
                    if (!is_null($statusValue)) {
                        $q->orWhere('status', $statusValue);
                    }
                })
                ->where('data_state', 0)
                ->get();

            $albums = Album::where(function($q) use ($query, $statusValue) {
                    $q->where('title', 'like', "%{$query}%")
                      ->orWhere('genre', 'like', "%{$query}%")
                      ->orWhere('description', 'like', "%{$query}%");
                    if (!is_null($statusValue)) {
                        $q->orWhere('status', $statusValue);
                    }
                })
                ->where('data_state', 0)
                ->get();

            $artists = Artist::where(function($q) use ($query, $statusValue) {
                    $q->where('name', 'like', "%{$query}%")
                      ->orWhere('description', 'like', "%{$query}%");
                    if (!is_null($statusValue)) {
                        $q->orWhere('status', $statusValue);
                    }
                })
                ->where('data_state', 0)
                ->get();
        }

        return view('dashboard', compact('songs', 'albums', 'artists', 'query'));
    }
}
