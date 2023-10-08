<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    use HasFactory;

    protected $fillable = ['number', 'user_id', 'balance'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function sentTransactions()
    {
        return $this->hasMany(Transaction::class, 'from_account_id');
    }

    public function receivedTransactions()
    {
        return $this->hasMany(Transaction::class, 'to_account_id');
    }
}
