<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DestinationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // return parent::toArray($request);

        return [
            'title' => $this->title,
            'slug' => $this->slug,
            'description' => $this->description,
            'location' => $this->location,
            'price' => $this->price,
            'images' => $this->images,
        ];
    }
}
