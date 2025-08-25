<?php

namespace App\Services;

use App\Http\Requests\DestinationRequest;
use App\Http\Resources\DestinationResource;
use App\Repositories\DestinationRepositoryInterface;
use App\Traits\UploadImage;

class DestinationService
{
    use UploadImage;
    private DestinationRepositoryInterface $destinationRepositoryInterface;

    public function __construct(DestinationRepositoryInterface $destinationRepositoryInterface)
    {
        $this->destinationRepositoryInterface = $destinationRepositoryInterface;
    }

    public function addDestination(DestinationRequest $destinationRequest)
    {
        $validated = $destinationRequest->validated();

        if ($destinationRequest->hasFile('images')) $validated['images'] = $this->upload('destination', $destinationRequest->file('images'));

        $result = $this->destinationRepositoryInterface->add($validated);

        return (object) new DestinationResource($result);
    }
}
