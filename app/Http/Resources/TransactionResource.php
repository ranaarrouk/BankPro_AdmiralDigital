<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use function Nette\Utils\data;

class TransactionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'type' => $this->type,
            'sender' => $this->senderAccount->user->name,
            'sender_account_number' => $this->senderAccount->number,
            'recipient' => $this->recipientAccount->user->name,
            'recipient_account_number' => $this->recipientAccount->number,
            'amount' => $this->amount . ' $',
            'creation_date' => $this->created_at->format('Y-m-d H:i:s')
        ];
    }
}
