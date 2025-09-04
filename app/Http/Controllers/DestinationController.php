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
        } catch (\Throwable $th) {
            DB::rollBack();
            return ResponseHelper::error(null, $th->getMessage());
        }
    }

    public function getAllDestination(Request $request)
    {
        return DestinationResource::collection($this->destinationService->getAllDestination($request->integer('per_page', 10), $request->get('sort_by', 'created_at'), $request->get('direction', 'asc')));
    }

    public function showDestination($slug)
    {
        try {
            return ResponseHelper::success(new DestinationResource($this->destinationRepository->showBySlug($slug)), 'berhasil mengambil data');
        } catch (\Throwable $th) {
            return ResponseHelper::error(null, $th->getMessage());
        }
    }

    public function updateDestination(DestinationRequest $request, $id)
    {
        DB::beginTransaction();
        try {
            $data = $this->destinationService->updateDestination($request, $id);

            DB::commit();
            return ResponseHelper::success(new DestinationResource($data), 'berhasil update destination');
        } catch (\Throwable $th) {
            DB::rollBack();
            return ResponseHelper::error(null, $th->getMessage());
        }
    }

    public function deleteDestination($id)
    {
        try {
            $this->destinationRepository->remove($id);
            return ResponseHelper::success(null, 'berhasil delete destination');
        } catch (\Throwable $th) {
            return ResponseHelper::error(null, $th->getMessage());
        }
    }
}
