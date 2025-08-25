<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = [
        'user_id',
        'package_id',
        'status',
        'price',
        'promo_code',
    ];

    public function User()
    {
        return $this->belongsTo(User::class);
    }

    public function Package()
    {
        return $this->belongsTo(Package::class);
    }
}
