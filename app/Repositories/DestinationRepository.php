<?php

namespace App\Repositories;

use App\Models\Destination;

class DestinationRepository implements DestinationRepositoryInterface
{
    public function add($data)
    {
        return Destination::create($data);
    }
    public function show($id)
    {

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
