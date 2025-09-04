<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseHelper;
use App\Http\Requests\BookingRequest;
use App\Http\Resources\BookingResource;
use App\Repositories\BookingRepositoryInterface;
use App\Services\BookingService;
use Illuminate\Http\Request;
use Auth;
use DB;

class BookingController extends Controller
{
    private BookingService $bookingService;
    private BookingRepositoryInterface $bookingRepository;

    public function __construct(BookingService $bookingService, BookingRepositoryInterface $bookingRepository)
    {
        $this->bookingService = $bookingService;
        $this->bookingRepository = $bookingRepository;
    }
    public function createBooking(BookingRequest $bookingRequest)
    {
        DB::beginTransaction();
        try {
            $data = $this->bookingService->addBooking($bookingRequest, Auth::user());

            DB::commit();
            return ResponseHelper::success(new BookingResource($data), 'berhasil booking');
        } catch (\Throwable $th) {
            DB::rollBack();
            return ResponseHelper::error(null, $th->getMessage());
        }
    }
    public function getBooking()
    {
        try {
            return ResponseHelper::success();
        } catch (\Throwable $th) {
            return ResponseHelper::error(null, $th->getMessage());
        }
    }
    public function getAllBooking()
    {
        return ResponseHelper::success(BookingResource::collection($this->bookingRepository->get()));
    }

    public function updateBooking(BookingRequest $request, $id)
    {
        DB::beginTransaction();
        try {
            DB::commit();

        } catch (\Throwable $th) {
            DB::rollBack();
            return ResponseHelper::error(null, $th->getMessage());
        }
    }
}
