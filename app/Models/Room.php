<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    protected $fillable = [
        'room_number',
        'type',
        'price',
        'is_available',
        'description',       // <= tambahkan ini
        'image_url',
    ];
}
