<?php

namespace App\Services;

use App\Helpers\ResponseHelper;
use App\Http\Requests\PackageRequest;
use App\Repositories\PackageRepositoryInterface;

class PackageService
{
    private PackageRepositoryInterface $packageRepository;

    public function __construct(PackageRepositoryInterface $packageRepository)
    {
        $this->packageRepository = $packageRepository;
    }

    public function addPackage(PackageRequest $request)
    {
        $validated =  $request->validated();

        $package = $this->packageRepository->create($validated);
        return (object) $package;
    }

    public function updatePackage(PackageRequest $request, $id)
    {
        $validated = $request->validated();
        return (object) $this->packageRepository->update($validated, $id);
    }

    public function deletePackage($id)
    {
        if (!$this->packageRepository->find($id)) {
            return ResponseHelper::error(null, 'package dengan id tersebut tidak dapat ditemukan');
        }
        return $this->packageRepository->delete($id);
    }
}
