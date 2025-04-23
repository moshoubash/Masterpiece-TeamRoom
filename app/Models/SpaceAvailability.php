<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SpaceAvailability extends Model
{
    protected $fillable = ['space_id', 'day_of_week', 'start_time', 'end_time', 'is_available'];
    public $timestamps = false;

    public function space()
    {
        return $this->belongsTo(Space::class, 'space_id', 'id');
    }
}
