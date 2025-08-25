<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseHelper;
use App\Http\Requests\BookingRequest;
use App\Http\Resources\BookingResource;
use App\Services\BookingService;
use Illuminate\Http\Request;
use Auth;
use DB;

class BookingController extends Controller
{
    private BookingService $bookingService;

    public function __construct(BookingService $bookingService)
    {
        $this->bookingService = $bookingService;
    }
    public function createBooking(BookingRequest $bookingRequest)
    {
        DB::beginTransaction();
        try {
            $data = $this->bookingService->addBooking($bookingRequest, Auth::user());

            DB::commit();
            return ResponseHelper::success(new BookingResource($data), 'berhasil booking');
        } catch (\Throwable $thrw) {
            DB::rollBack();
            return ResponseHelper::error(null, $thrw->getMessage());
        }
    }
    public function getBooking()
    {
        try {
            return ResponseHelper::success();
        } catch (\Throwable $thrw) {
            return ResponseHelper::error(null, $thrw->getMessage());
        }
    }
    public function getAllBooking()
    {

    }
}
