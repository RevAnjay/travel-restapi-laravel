<?php

namespace App\Services;

use App\Http\Requests\BookingRequest;
use App\Models\Booking;
use App\Repositories\BookingRepositoryInterface;

class BookingService
{
    private BookingRepositoryInterface $bookingRepository;
    public function __construct(BookingRepositoryInterface $bookingRepository)
    {
        $this->bookingRepository = $bookingRepository;
    }
    public function addBooking($bookingRequest, $user)
    {
        $validated = $bookingRequest->validated();

        // $booking = Booking::create([
        //     'user_id' => $user->id,
        //     'package_id' => $validated['package_id'],
        //     'status' => $validated['status'] ?? 'pending',
        //     'price' => $validated['price'],
        //     'promo_code' => $validated['promo_code'] ?? null,
        // ]);
        $validated["user_id"] = $user->id;
        $validated["status"] = $validated['status'] ?? 'pending';
        $validated["promo_code"] = $validated['promo_code'] ?? null;

        return (object) $this->bookingRepository->create($validated);
    }
    public function showBooking($user)
    {
        $data = $this->bookingRepository->find($user->id);
        return (object) $data;
    }
    public function updateBooking(BookingRequest $request, $id)
    {
        $validated = $request->validated();
        return (object) $this->bookingRepository->update($validated, $id);
    }
}
