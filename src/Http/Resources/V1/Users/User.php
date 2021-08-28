<?php


namespace Seatplus\Api\Http\Resources\V1\Users;

use Seatplus\Api\Http\Resources\V1\Character;

class User extends \Illuminate\Http\Resources\Json\JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'main_character' => Character::make($this->whenLoaded('main_character')),
            'characters' => Character::collection($this->whenLoaded('characters')),
        ];
    }
}
