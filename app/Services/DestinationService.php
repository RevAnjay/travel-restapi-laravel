<?php

namespace App\Services;

use App\Http\Requests\DestinationRequest;
use App\Http\Resources\DestinationResource;
use App\Repositories\DestinationRepositoryInterface;
use App\Traits\UploadImage;

class DestinationService
{
    use UploadImage;
    private DestinationRepositoryInterface $destinationRepository;

    public function __construct(DestinationRepositoryInterface $destinationRepository)
    {
        $this->destinationRepository = $destinationRepository;
    }

    public function addDestination(DestinationRequest $destinationRequest)
    {
        $validated = $destinationRequest->validated();

        if ($destinationRequest->hasFile('images')) $validated['images'] = $this->upload('destination', $destinationRequest->file('images'));

        $result = $this->destinationRepository->add($validated);

        return new DestinationResource($result);
    }

    public function updateDestination(DestinationRequest $request, $id)
    {
        $validated = $request->validated();

        return (object) $this->destinationRepository->update($validated, $id);
    }

    public function getAllDestination(int $perPage = 10, string $sortBy = 'created_at', string $direction = 'asc')
    {
        $allowedShort = ['created_at', 'price', 'title'];
        if (!in_array($sortBy, $allowedShort)) {
            $sortBy = 'created_at';
        }

        $direction = strtolower($direction) === 'asc' ? 'asc' : 'desc';

        return $this->destinationRepository->all($perPage, $sortBy, $direction);
    }
}
