<?php

use function Pest\Laravel\actingAs;
use Seatplus\Auth\Models\Permissions\Permission;
use Seatplus\Auth\Models\User;

beforeEach(function () {
    $user = \Seatplus\Auth\Models\User::first();

    expect($user->can('superuser'))->toBeFalse();

    $permission = Permission::findOrCreate('superuser');

    $user->givePermissionTo($permission);
});

it('user got superuser rights', function () {
    expect($this->test_user->can('superuser'))->toBeTrue();
});

it('user can access api view', function () {
    $response = actingAs($this->test_user)->get(route('api.index'))
        ->assertInertia(fn (\Inertia\Testing\AssertableInertia $page) => $page
            ->component('Api/Index'));
});

test('user can create a new api token', function () {
    $api_user = \Seatplus\Api\Models\ApiUser::first();

    expect($api_user->tokens)->toHaveCount(0);

    actingAs(User::first())->post(route('create.api.token'), [
        'token_name' => 'TestTokenName',
        'abilities' => ['superuser'],
    ])->assertOk();

    expect($api_user->refresh()->tokens)->toHaveCount(1);
});
