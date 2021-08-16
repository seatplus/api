<?php


namespace Seatplus\Api\Http\Controllers;


use Illuminate\Http\Request;
use Seatplus\Api\Models\ApiUser;

class TokenController
{
    public function index()
    {
        $user = auth()->user();

        return inertia('Api/Index', [
            'tokens' => ApiUser::find($user->getAuthIdentifier())->tokens,
            'permissions' => $user->getAllPermissions()->map(fn($permission) => $permission->name),
        ]);
    }

    public function create(Request $request)
    {

        $validated_data = $request->validate([
            'token_name' => ['required', 'string'],
            'abilities' => ['required', 'array'],
        ]);

        $user = auth()->user();
        $tokens = ApiUser::find($user->getAuthIdentifier())->tokens;

        $token = ApiUser::find($user->getAuthIdentifier())->createToken(
            $validated_data['token_name'],
            $validated_data['abilities'],
        );

        return inertia('Api/Index', [
            'tokens' => $tokens,
            'plainTextToken' => $token->plainTextToken
        ]);
    }

    public function delete(int $tokenId)
    {
        return ApiUser::find(auth()->user()->getAuthIdentifier())
            ->tokens()
            ->where('id', $tokenId)
            ->delete();
    }

}