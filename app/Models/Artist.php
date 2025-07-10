<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Artist extends Model
{
    protected $table = 'artists';

    protected $fillable = [
        'name',
        'description',
        'status',
        'data_state',
    ];

    public function albums()
    {
        return $this->hasMany(Album::class, 'artist_id');
    }

    public function songs()
    {
        return $this->hasMany(Song::class, 'artist_id');
    }
}
