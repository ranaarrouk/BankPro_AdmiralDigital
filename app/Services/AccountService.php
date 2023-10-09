<?php


namespace App\Services;


use App\Models\Account;
use App\Models\User;
use App\Repositories\Interfaces\AccountRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use App\Services\TransactionServiceInterface;

class AccountService implements AccountServiceInterface
{
    private AccountRepositoryInterface $accountRepository;
    private TransactionServiceInterface $transactionService;

    public function __construct(AccountRepositoryInterface $accountRepository, TransactionServiceInterface $transactionService)
    {
        $this->accountRepository = $accountRepository;
        $this->transactionService = $transactionService;
    }

    public function create(User $user)
    {
        $data['user_id'] = $user->id;
        do {
            $accountNumber = rand(1000000000, 9999999999); // Generate a 10-digit random number
        } while ($this->accountRepository->newQuery()->where(['number' => $accountNumber])->exists());
        $data['number'] = $accountNumber;
        $data['balance'] = 0;
        return $this->accountRepository->create($data);
    }

    public function deposit($data): void
    {
        $account = Auth::user()->account;
        $this->accountRepository->deposit($account, $account->balance + $data['amount']);
        $this->transactionService->createDepositTransaction($account, $data['amount']);
    }

    public function transferMoney($accountNumber, $amount): void
    {
        // TODO: Implement transferMoney() method.
    }

}
