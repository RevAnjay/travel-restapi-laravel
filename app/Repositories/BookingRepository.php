<?php

namespace App\Repositories;

use App\Models\Booking;

class BookingRepository implements BookingRepositoryInterface
{
    public function get()
    {
        return Booking::all();
    }

    public function find($id)
    {
        return Booking::find($id);
    }

    public function create($request)
    {
        return Booking::create($request);
    }
    public function update($request, $id)
    {
        $package = Booking::find($id);

        return $package->update($request);
    }
    public function delete($id)
    {
        return Booking::destroy($id);
    }
}
