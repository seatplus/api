<?php


namespace Seatplus\Api\Http\Resources\V1;


use Illuminate\Http\Resources\Json\JsonResource;

class WalletJournal extends JsonResource
{
    public function toArray($request)
    {
        return [

            // required props
            'date' => $this->date,
            'description' => $this->description,
            'ref_type' => $this->ref_type,
            // nullable props
            'amount' => $this->amount,
            'balance' => $this->balance,
            'contextable_id' => $this->contextable_id,
            'contextable_type' => $this->contextable_type,
            'first_party_id' => $this->first_party_id,
            'second_party_id' => $this->second_party_id,
            'reason' => $this->reason,
            'tax' => $this->tax,
            'tax_receiver_id' => $this->tax_receiver_id,
        ];
    }

}