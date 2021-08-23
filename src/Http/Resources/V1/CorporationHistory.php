<?php


namespace Seatplus\Api\Http\Resources\V1;

use Illuminate\Http\Resources\Json\JsonResource;

class CorporationHistory extends JsonResource
{
    public function toArray($request)
    {
        return [
            'corporation_id' => $this->corporation_id,
            'is_deleted' => $this->is_deleted,
            'start_date' => $this->start_date,
        ];
    }
}
