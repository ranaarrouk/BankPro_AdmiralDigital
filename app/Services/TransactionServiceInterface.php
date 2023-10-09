<?php


namespace App\Services;


use App\Models\Account;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

interface TransactionServiceInterface
{
    public function getUserTransactions(array $data): Collection;

    public function createDepositTransaction(Account $account, $amount) : Model;

    public function createTransferTransaction(Account $from, Account $to, $amount) : Model;
}
