<?php


namespace Seatplus\Api\Http\Controllers\Api\V1;




class Users
{
    public function __invoke()
    {
        $query = \Seatplus\Auth\Models\User::query()
            ->with('main_character');

        return \Seatplus\Api\Http\Resources\V1\Users\User::collection($query->paginate());
    }

}