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

    }

    public function showBySlug($slug)
    {
        return Destination::where('slug', $slug)->first();
    }
    public function all(){
        return Destination::all();
    }
    public function update($data, $id)
    {

    }
    public function remove($id)
    {

    }
}
