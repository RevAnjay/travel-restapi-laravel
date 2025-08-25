<?php

namespace App\Services;

use App\Http\Requests\BookingRequest;
use App\Models\Booking;

class BookingService
{
    public function addBooking($bookingRequest, $user)
    {
        $validated = $bookingRequest->validated();

        $booking = Booking::create([
            'user_id' => $user->id,
            'package_id' => $validated['package_id'],
            'status' => $validated['status'] ?? 'pending',
            'price' => $validated['price'],
            'promo_code' => $validated['promo_code'] ?? null,
        ]);

        return (object) $booking;
    }
    public function showBooking($user)
    {
        $data = Booking::find($user->id);
        return (object) $data;
    }
    public function getAllBooking()
    {

    }
}
