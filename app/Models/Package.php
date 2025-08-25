<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    /** @use HasFactory<\Database\Factories\PackageFactory> */
    use HasFactory;

    protected $fillable = [
        'destination_id',
        'name',
        'description',
        'price',
        'duration_days'
    ];

    public function Destinations()
    {
        return $this->hasMany(Destination::class);
    }
}
