<?php


namespace App\Services;


use App\Models\Account;
use App\Models\User;
use App\Repositories\Interfaces\AccountRepositoryInterface;

class AccountService implements AccountServiceInterface
{
    private AccountRepositoryInterface $accountRepository;

    public function __construct(AccountRepositoryInterface $accountRepository)
    {
        $this->accountRepository = $accountRepository;
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
}
