<?php


namespace Seatplus\Api\Http\Controllers\Api\V1;

use Seatplus\Eveapi\Models\Character\CorporationHistory as CorporationHistoryModel;

class CorporationHistory
{
    public function __invoke(int $character_id)
    {
        $query = CorporationHistoryModel::query()
            ->where('character_id', $character_id);

        return \Seatplus\Api\Http\Resources\V1\CorporationHistory::collection($query->paginate());
    }
}
