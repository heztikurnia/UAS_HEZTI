<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Song extends Model
{
    protected $table = 'songs';

    protected $fillable = [
        'title',
        'artist_id',
        'album_id',
        'duration',
        'genre',
        'description',
        'status', // null for non-valid, 0 for valid, 1 for invalid
        'data_state', // 0 for active, 1 for deleted
    ];

    public function artist()
    {
        return $this->belongsTo(Artist::class, 'artist_id');
    }

    public function album()
    {
        return $this->belongsTo(Album::class, 'album_id');
    }
}
