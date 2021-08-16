<?php


namespace Seatplus\Api\Http\Controllers\Api\V1;

use Seatplus\Api\Http\Resources\V1\User as UserResource;
use Seatplus\Auth\Models\User as UserModel;

class User
{
    public function __invoke(int $user_id)
    {
        $user = UserModel::query()->with('characters')->find($user_id);

        return UserResource::make($user);
    }
}
