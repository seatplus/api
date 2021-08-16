<?php


namespace Seatplus\Api\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Seatplus\Api\Models\ApiUser;
use Seatplus\Auth\Models\User;

class TokenAbilityCheck
{
    private User $user;

    private ApiUser $apiUser;

    public function handle(Request $request, Closure $next, string $ability)
    {
        $this->setUser($request->user());
        $abilities = ['superuser', $ability];

        foreach ($abilities as $ability) {
            if ($this->getApiUser()->tokenCan($ability)) {
                if ($this->userGotAbilityAsPermission($ability)) {
                    return $next($request);
                }
            }
        }

        abort(403, 'you do not have the required token permissions to perform this action');
    }

    private function getUser() : User
    {
        return $this->user;
    }

    /**
     * @param ApiUser $apiUser
     */
    public function setUser(ApiUser $apiUser): void
    {
        $this->apiUser = $apiUser;
        $this->user = User::find($apiUser->id);
    }

    /**
     * @return ApiUser
     */
    public function getApiUser(): ApiUser
    {
        return $this->apiUser;
    }

    /**
     * @param ApiUser $apiUser
     */
    public function setApiUser(ApiUser $apiUser): void
    {
        $this->apiUser = $apiUser;
    }

    private function userGotAbilityAsPermission(string $ability)
    {
        $user_permissions = $this->getUser()
            ->getAllPermissions()
            ->map(fn ($permission) => $permission->name)
            ->toArray();

        return in_array($ability, $user_permissions);
    }
}
