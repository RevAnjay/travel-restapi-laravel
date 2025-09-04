<?php

namespace App\Repositories;

use App\Models\Package;

class PackageRepository implements PackageRepositoryInterface
{
    public function get()
    {
        return Package::all();
    }

    public function find($id)
    {
        return Package::find($id);
    }

    public function create($request)
    {
        return Package::create($request);
    }
    public function update($request, $id)
    {
        $package = Package::find($id);
        $package->update($request);

        return $package;
    }
    public function delete($id)
    {
        return Package::destroy($id);
    }
}
