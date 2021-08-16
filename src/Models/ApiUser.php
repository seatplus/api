<?php


namespace Seatplus\Api\Models;

use Laravel\Sanctum\HasApiTokens;
use Seatplus\Auth\Models\User;

class ApiUser extends User
{
    use HasApiTokens;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'users';
}
