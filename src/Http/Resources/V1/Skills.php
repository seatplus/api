<?php


namespace Seatplus\Api\Http\Resources\V1;


use Illuminate\Http\Resources\Json\JsonResource;

class Skills extends JsonResource
{
    public function toArray($request)
    {
        return [
            'active_skill_level' => $this->active_skill_level,
            'skill_id' => $this->skill_id,
            'skillpoints_in_skill' => $this->skillpoints_in_skill,
            'trained_skill_level' => $this->trained_skill_level,
        ];
    }

}