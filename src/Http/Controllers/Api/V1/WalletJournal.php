<?php


namespace Seatplus\Api\Http\Controllers\Api\V1;


class WalletJournal
{

    public function __invoke(int $character_id)
    {
        $query = \Seatplus\Eveapi\Models\Wallet\WalletJournal::query()
            ->where('wallet_journable_id', $character_id);

        return \Seatplus\Api\Http\Resources\V1\WalletJournal::collection($query->paginate());
    }

}