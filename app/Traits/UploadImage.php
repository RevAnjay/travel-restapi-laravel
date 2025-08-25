<?php

namespace App\Traits;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

trait UploadImage
{
    public function exists($file)
    {
        return Storage::exists($file);
    }

    public function upload($path, UploadedFile $file)
    {
        if (!$this->exists($path)) Storage::makeDirectory($path);

        return $file->storeAs($path, $file->hashName());
    }

    public function remove($file)
    {
        return Storage::delete($file);
    }
}
