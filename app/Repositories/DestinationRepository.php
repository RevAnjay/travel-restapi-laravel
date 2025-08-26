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
        $destination = Destination::where('slug', $slug);
        return $destination;
    }
    public function all(){

    }
    public function update($data, $id)
    {

    }
    public function remove($id)
    {

    }
}
