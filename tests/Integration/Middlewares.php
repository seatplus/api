<?php

use Laravel\Sanctum\Sanctum;
use Seatplus\Api\Models\ApiUser;

test('token-ability-check middleware let requests through if required ability is present', function () {
    $this->test_user->givePermissionTo('superuser');

    Sanctum::actingAs(ApiUser::find($this->test_user->id), ['superuser']);

    $response = $this->get('/api/v1/users');

    $response->assertOk();
});

test('token-ability-check middleware blocks requests if ability is missing', function () {
    Sanctum::actingAs(ApiUser::find($this->test_user->id), ['some_other_ability']);

    $response = $this->get('/api/v1/users')->assertForbidden();
});
