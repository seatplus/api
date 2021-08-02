<?php


namespace Seatplus\Api\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Laravel\Sanctum\HasApiTokens;
use Seatplus\Auth\Models\User;

class ApiUser extends User
{
    use HasApiTokens;

}