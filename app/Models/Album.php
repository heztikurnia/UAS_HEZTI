<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Album extends Model
{
    protected $table = 'albums';

    protected $fillable = [
        'title',
        'artist_id',
        'release_date',
        'genre',
        'description',
        'status',
        'data_state',
    ];

    public function artist()
    {
        return $this->belongsTo(Artist::class, 'artist_id');
    }

    public function songs()
    {
        return $this->hasMany(Song::class, 'album');
    }
}
