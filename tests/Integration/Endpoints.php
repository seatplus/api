<?php

use Laravel\Sanctum\Sanctum;
use Seatplus\Api\Models\ApiUser;

beforeEach(function () {
    $this->test_user->givePermissionTo('superuser');

    Sanctum::actingAs(ApiUser::find($this->test_user->id), ['superuser']);
});

test('/api/v1/users', function () {
    $this->get('api/v1/users')->assertOk();
});

test('/api/v1/users/1', function () {
    expect(\Seatplus\Auth\Models\User::all())->toHaveCount(1);
    $user_id = \Seatplus\Auth\Models\User::first()->id;

    $this->get("api/v1/users/$user_id")->assertOk();
});

test('/api/v1/characters/{character_id}/skills', function () {
    \Seatplus\Eveapi\Models\Skills\Skill::factory()
        ->create(['character_id' => $this->test_character->character_id]);

    $this->get("/api/v1/characters/{$this->test_character->character_id}/skills")->assertOk();
});

test('/api/v1/characters/{character_id}/wallet/journal', function () {
    \Seatplus\Eveapi\Models\Wallet\WalletJournal::factory()
        ->create([
            'wallet_journable_id' => $this->test_character->character_id,
            'wallet_journable_type' => \Seatplus\Eveapi\Models\Character\CharacterInfo::class,
        ]);

    $this->get("/api/v1/characters/{$this->test_character->character_id}/wallet/journal")->assertOk();
});

test('/api/v1/characters/{character_id}/corporationhistory', function () {
    \Seatplus\Eveapi\Models\Character\CorporationHistory::factory()
        ->create([
            'start_date' => faker()->dateTime,
            'character_id' => $this->test_character->character_id,
        ]);

    $this->get("/api/v1/characters/{$this->test_character->character_id}/corporationhistory")->assertOk();
});

test('/api/v1/characters/{character_id}/contacts', function () {
    \Seatplus\Eveapi\Models\Contacts\Contact::factory()
        ->create([
            'contactable_id' => $this->test_character->character_id,
            'contactable_type' => \Seatplus\Eveapi\Models\Character\CharacterInfo::class,
        ]);

    $this->get("/api/v1/characters/{$this->test_character->character_id}/contacts")->assertOk();
});
