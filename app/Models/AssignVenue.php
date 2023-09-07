<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssignVenue extends Model
{
    use HasFactory;

    public function venues()
    {
        return $this->hasOne(Venue::class, 'id', 'venue_id');
    }
}
