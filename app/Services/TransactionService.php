<?php


namespace App\Services;


use App\Models\Account;
use App\TransactionType;
use Illuminate\Database\Eloquent\Model;
use App\Repositories\Interfaces\TransactionRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;

class TransactionService implements TransactionServiceInterface
{

    private TransactionRepositoryInterface $transactionRepository;

    public function __construct(TransactionRepositoryInterface $transactionRepository)
    {
        $this->transactionRepository = $transactionRepository;
    }

    public function getUserTransactions(array $data): Collection
    {
        $conditions = [
            ['from_account_id', '=', Auth::id()],
            ['to_account_id', '=', Auth::id()],
        ];
        return $this->transactionRepository->whereOrWhere($conditions, ['*'], ['senderAccount.user', 'recipientAccount.user'], true);
    }

    public function createDepositTransaction(Account $account, $amount): Model
    {
        $this->fillAttributes($attributes,TransactionType::DEPOSIT, $account, $account, $amount);
        return $this->transactionRepository->create($attributes);
    }

    public function createTransferTransaction(Account $from, Account $to, $amount): Model
    {
        $this->fillAttributes($attributes,TransactionType::TRANSFER, $from, $to, $amount);
        return $this->transactionRepository->create($attributes);
    }

    private function fillAttributes(&$attributes, $type, Account $from, Account $to, $amount)
    {
        $attributes['type'] = $type;
        $attributes['from_account_id'] = $from->id;
        $attributes['to_account_id'] = $to->id;
        $attributes['amount'] = $amount;
    }
}
