<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Amenity extends Model
{
    protected $fillable = ['name', 'icon'];

    public function spaces()
    {
        return $this->belongsToMany(Space::class, 'space_amenities', 'amenity_id', 'space_id');
    }
}