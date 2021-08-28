<?php


namespace Seatplus\Api\Http\Controllers\Api\V1;

use Illuminate\Database\Eloquent\Builder;
use Seatplus\Eveapi\Models\Character\CharacterInfo;

class Contact
{
    public function __invoke(int $character_id)
    {
        $query = \Seatplus\Eveapi\Models\Contacts\Contact::query()
            ->whereHasMorph(
                'contactable',
                CharacterInfo::class,
                fn (Builder $query) => $query->where('character_id', $character_id)
            );

        return \Seatplus\Api\Http\Resources\V1\Contact::collection($query->paginate());
    }
}
