<?php

namespace App\Repositories;

interface DestinationRepositoryInterface
{
    public function add($data);
    public function showById($id);
    public function showBySlug($slug);
    public function all();
    public function update($data, $id);
    public function remove($id);
}
