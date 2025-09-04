<?php

namespace App\Repositories;

use App\Models\Destination;

class DestinationRepository implements DestinationRepositoryInterface
{
    public function add($data)
    {
        return Destination::create($data);
    }
    public function showById($id)
    {
        return Destination::findOrFail($id);
    }

    public function showBySlug($slug)
    {
        return Destination::where('slug', $slug)->first();
    }
    public function all(int $perPage = 10, string $sortBy = 'created_at', string $direction = 'asc'){
        return Destination::query()->orderBy($sortBy, $direction)->paginate($perPage);
    }
    public function update($data, $id)
    {
        $destination = Destination::find($id);

        $destination->update($data);
        return $destination;
    }
    public function remove($id)
    {
        return Destination::destroy($id);
    }
}
