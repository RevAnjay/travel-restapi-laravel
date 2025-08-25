<?php

namespace App\Repositories;

interface DestinationRepositoryInterface
{
    public function add($data);
    public function show($id);
    public function all();
    public function update($data, $id);
    public function remove($id);
}
