<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AvailabilityException extends Model
{
    protected $fillable = ['space_id', 'exception_date', 'is_available', 'start_time', 'end_time', 'reason'];

    public function space()
    {
        return $this->belongsTo(Space::class, 'space_id', 'id');
    }
}
