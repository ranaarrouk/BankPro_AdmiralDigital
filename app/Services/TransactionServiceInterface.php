<?php


namespace App\Services;


use Illuminate\Database\Eloquent\Collection;

interface TransactionServiceInterface
{

    public function getUserTransactions(array $data): Collection;

    public function deposit($amount) : void;

    public function transferMoney($accountNumber, $amount) : void;
}
