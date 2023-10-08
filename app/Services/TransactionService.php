<?php


namespace App\Services;


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

    public function deposit($amount): void
    {
        // TODO: Implement deposit() method.
    }

    public function transferMoney($accountNumber, $amount): void
    {
        // TODO: Implement transferMoney() method.
    }

    public function getUserTransactions(array $data): Collection
    {
        $criteria['from_account_id'] = Auth::id();
        $criteria['to_account_id'] = Auth::id();
        return $this->transactionRepository->getByCriteria($criteria);
    }
}
