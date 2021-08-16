<?php


namespace Seatplus\Api\Http\Resources\V1\Users;


class Users extends \Illuminate\Http\Resources\Json\JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'main_character' => $this->main_character,
        ];
    }

}