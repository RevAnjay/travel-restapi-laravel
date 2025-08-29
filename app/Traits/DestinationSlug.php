<?php

namespace App\Traits;

use Str;

trait DestinationSlug
{
    protected static function bootDestinationSlug()
    {
        static::creating(function ($model) {
            if (empty($model->slug)) {
                $slug = Str::slug($model->title);

                $originalSlug = $slug;
                $count = 1;

                while($model->newQuery()->where('slug', $slug)->exists()) {
                    $slug = $originalSlug . '-' . $count++;
                }

                $model->slug = $slug;
            }
        });
    }
}
