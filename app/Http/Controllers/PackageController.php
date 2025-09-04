<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseHelper;
use App\Http\Requests\PackageRequest;
use App\Http\Resources\PackageResource;
use App\Repositories\PackageRepositoryInterface;
use App\Services\PackageService;
use DB;
use Illuminate\Http\Request;
use Log;

class PackageController extends Controller
{
    private PackageRepositoryInterface $packageRepository;
    private PackageService $packageService;

    public function __construct(PackageRepositoryInterface $packageRepository, PackageService $packageService)
    {
        $this->packageRepository = $packageRepository;
        $this->packageService = $packageService;
    }

    public function addPackage(PackageRequest $request)
    {
        DB::beginTransaction();
        try {
            $package = new PackageResource($this->packageService->addPackage($request));

            DB::commit();
            return ResponseHelper::success($package, 'berhasil menambahkan package');
        } catch (\Throwable $th) {
            DB::rollBack();
            return ResponseHelper::error(null, $th->getMessage());
        }
    }

    public function getAllPackage()
    {
        return ResponseHelper::success(PackageResource::collection($this->packageRepository->get()), 'berhasil mengambil semua data package');
    }

    public function updatePackage(PackageRequest $request, $id)
    {
        DB::beginTransaction();
        try {
            $package = new PackageResource($this->packageService->updatePackage($request, $id));

            DB::commit();
            return ResponseHelper::success($package, 'sukses update data package');
        } catch (\Throwable $th) {
            DB::commit();
            return ResponseHelper::error(null, $th->getMessage());
        }
    }

    public function deletePackage($id)
    {
        try {
            $this->packageService->deletePackage($id);
            return ResponseHelper::success(null, "berhasil menghapus package");
        } catch (\Throwable $th) {
            Log::error('error pada function deletPackage '. $th->getMessage());
            return ResponseHelper::error(null, $th->getMessage());
        }
    }

    public function showPackage($id)
    {
        return ResponseHelper::success(new PackageResource($this->packageRepository->find($id)), 'berhasil ambil data package');
    }
}
