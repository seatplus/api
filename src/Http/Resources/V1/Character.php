<?php


namespace Seatplus\Api\Http\Resources\V1;

use Illuminate\Http\Resources\Json\JsonResource;

class Character extends JsonResource
{
    public function toArray($request)
    {
        return [
            'character_id' => $this->character_id,
            'name' => $this->name,
            'birthday' => $this->birthday,
            'balance' => Balance::make($this->whenLoaded('balance')),
            'total_sp' => $this->total_sp,
            'unallocated_sp' => $this->unallocated_sp,
        ];
    }
}
