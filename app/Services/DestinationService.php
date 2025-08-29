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
}
