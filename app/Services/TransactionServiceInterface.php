<?php


namespace App\Services;


use Illuminate\Database\Eloquent\Collection;

interface TransactionServiceInterface
{

    public function getUserTransactions(array $data): Collection;
}
