<?php


namespace Seatplus\Api\Http\Resources\V1;

use Illuminate\Http\Resources\Json\JsonResource;

class Balance extends JsonResource
{
    public function toArray($request)
    {
        return [
            $this->balance
        ];
    }
}
