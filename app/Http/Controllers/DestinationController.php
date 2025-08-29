<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseHelper;
use App\Http\Requests\DestinationRequest;
use App\Http\Resources\DestinationResource;
use App\Repositories\DestinationRepositoryInterface;
use App\Services\DestinationService;
use Illuminate\Http\Request;
use DB;

class DestinationController extends Controller
{
    private DestinationService $destinationService;
    private DestinationRepositoryInterface $destinationRepository;

    public function __construct(DestinationService $destinationService, DestinationRepositoryInterface $destinationRepository)
    {
        $this->destinationService = $destinationService;
        $this->destinationRepository = $destinationRepository;
    }

    public function addDestination(DestinationRequest $destinationRequest)
    {
        DB::beginTransaction();
        try {
            $data = $this->destinationService->addDestination($destinationRequest);

            DB::commit();
            return ResponseHelper::success($data, 'berhasil menambahkan destinasi baru');
        } catch (\Throwable $thrw) {
            DB::rollBack();
            return ResponseHelper::error(null, $thrw->getMessage());
        }
    }

    public function getAllDestination()
    {
        return DestinationResource::collection($this->destinationRepository->all());
    }

    public function showDestination($slug)
    {
        try {
            return ResponseHelper::success(new DestinationResource($this->destinationRepository->showBySlug($slug)), 'berhasil mengambil data');
        } catch (\Throwable $thrw) {
            return ResponseHelper::error(null, $thrw->getMessage());
        }
    }
}
