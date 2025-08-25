<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseHelper;
use App\Http\Requests\DestinationRequest;
use App\Services\DestinationService;
use Illuminate\Http\Request;
use DB;

class DestinationController extends Controller
{
    private DestinationService $destinationService;

    public function __construct(DestinationService $destinationService)
    {
        $this->destinationService = $destinationService;
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
}
