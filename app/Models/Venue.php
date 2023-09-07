<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Venue extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'private_public',
        'name',
        'type',
        'is_activated',
        'description',
        'phone_number',
        'email_address',
        'website',
        'full_address',
        'latitude',
        'longitude',
        'activated_at',
        'user_id',
    ];

    protected $dates = ['deleted_at'];

    protected $appends = [
        'formatted_created_at'
    ];

    public function getFormattedCreatedAtAttribute(): string
    {
        return $this->created_at->format('d M Y');
    }
}
