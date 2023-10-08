<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = ['type', 'from_account_id', 'to_account_id', 'amount'];

    public function senderAccount()
    {
        return $this->hasMany(Account::class, 'from_account_id');
    }

    public function recipientAccount()
    {
        return $this->hasMany(Account::class, 'to_account_id');
    }


}
