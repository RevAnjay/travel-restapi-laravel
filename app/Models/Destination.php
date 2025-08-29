<?php

namespace App\Models;

use App\Traits\DestinationSlug;
use Illuminate\Database\Eloquent\Model;

class Destination extends Model
{
    use DestinationSlug;

    protected $fillable = [
        'title',
        'slug',
        'description',
        'location',
        'price',
        'images'
    ];
}
