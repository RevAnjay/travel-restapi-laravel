<?php

namespace App\Repositories;

interface PackageRepositoryInterface
{
    public function get();
    public function find($id);
    public function create($request);
    public function update($request, $id);
    public function delete($id);
}
