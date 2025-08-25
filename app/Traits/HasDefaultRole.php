<?php

namespace App\Traits;

trait HasDefaultRole
{
    protected static function bootHasDefaultRole()
    {
        static::created(function ($model) {
            return $model->assignRole("user");
        });
    }
}
