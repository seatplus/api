<?php


namespace Seatplus\Api\Http\Controllers\Api\V1;


use Seatplus\Api\Http\Resources\V1\Skills as SkillsResource;
use Seatplus\Eveapi\Models\Skills\Skill;

class Skills
{
    public function __invoke(int $character_id)
    {
        $query = Skill::query()
            ->where('character_id', $character_id);

        return SkillsResource::collection($query->paginate());
    }

}