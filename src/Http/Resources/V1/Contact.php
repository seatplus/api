<?php


namespace Seatplus\Api\Http\Resources\V1;

use Illuminate\Http\Resources\Json\JsonResource;

class Contact extends JsonResource
{
    public function toArray($request)
    {
        return [

            'contact_id' => $this->contact_id,
            'contact_type' => $this->contact_type,
            'is_blocked' => $this->is_blocked,
            'is_watched' => $this->is_watched,
            'standing' => $this->standing,
        ];
    }
}
