<?php


namespace Seatplus\Api\Models;

use Laravel\Sanctum\HasApiTokens;
use Seatplus\Auth\Models\User;

class ApiUser extends User
{
    use HasApiTokens;
}
