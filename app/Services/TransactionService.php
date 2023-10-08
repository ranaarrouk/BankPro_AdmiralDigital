<?php


namespace App\Services;


use App\Repositories\Interfaces\TransactionRepositoryInterface;

class TransactionService implements TransactionServiceInterface
{

    private TransactionRepository $transactionRepository;

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
}
