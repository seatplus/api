<?php


namespace Seatplus\Api\Http\Controllers\Api\V1;

use Seatplus\Auth\Models\User as UserModel;

class User
{
    public function __invoke(int $user_id)
    {
        $user = UserModel::query()->with(['characters.balance', 'main_character.balance'])->find($user_id);

        return \Seatplus\Api\Http\Resources\V1\Users\User::make($user);
    }
}
