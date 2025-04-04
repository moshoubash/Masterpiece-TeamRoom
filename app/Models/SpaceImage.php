<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SpaceImage extends Model
{
    protected $fillable = ['space_id', 'image_url', 'caption'];

    public function space()
    {
        return $this->belongsTo(Space::class, 'space_id', 'id');
    }
}