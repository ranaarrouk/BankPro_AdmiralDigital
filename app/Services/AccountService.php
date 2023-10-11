<?php


namespace App\Services;


use App\Exceptions\InsufficientBalanceException;
use App\Exceptions\InvalidAccountNumberException;
use App\Models\Account;
use App\Models\User;
use App\Repositories\Interfaces\AccountRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use App\Services\TransactionServiceInterface;
use Illuminate\Database\Eloquent\Model;

class AccountService implements AccountServiceInterface
{
    private AccountRepositoryInterface $accountRepository;
    private TransactionServiceInterface $transactionService;

    /**
     * AccountService constructor.
     * @param AccountRepositoryInterface $accountRepository
     * @param \App\Services\TransactionServiceInterface $transactionService
     */
    public function __construct(AccountRepositoryInterface $accountRepository, TransactionServiceInterface $transactionService)
    {
        $this->accountRepository = $accountRepository;
        $this->transactionService = $transactionService;
    }

    /**
     * Create account for a user
     * @param User $user
     * @return Model
     */
    public function create(User $user): Model
    {
        $data['user_id'] = $user->id;
        // Generate new account number with check if it already exists
        do {
            $accountNumber = rand(1000000000, 9999999999); // Generate a 10-digit random number
        } while ($this->accountRepository->newQuery()->where(['number' => $accountNumber])->exists());

        $data['number'] = $accountNumber;
        $data['balance'] = 0;
        return $this->accountRepository->create($data); // Create the account
    }

    /**
     * @param $data
     */
    public function deposit($data): void
    {
        $account = Auth::user()->account;
        // Deposit and adjust the balance
        $this->accountRepository->deposit($account, $account->balance + $data['amount']);
        // Create Deposit Transaction
        $this->transactionService->createDepositTransaction($account, $data['amount']);
    }

    /**
     * @param $data
     * @throws InsufficientBalanceException
     * @throws InvalidAccountNumberException
     */
    public function transferMoney($data): void
    {
        // Get Sender account
        $account = Auth::user()->account;
        // Get recipient account number
        $accountNumber = $data['account_number'];
        // Get recipient account
        $toAccount = $this->accountRepository->findByCriteria(['number' => $accountNumber]); // Recipient account
        $amount = $data['amount']; // Amount to transfer

        if (!$toAccount)
            throw new InvalidAccountNumberException();

        if ($amount > $account->balance)
            throw new InsufficientBalanceException();

        // Update the sender account balance (Decrease)
        $this->accountRepository->update($account, ['balance' => $account->balance - $amount]);
        // Update the recipient account balance (Increase)
        $this->accountRepository->update($toAccount, ['balance' => $toAccount->balance + $amount]);
        // Create Transfer Transaction
        $this->transactionService->createTransferTransaction($account, $toAccount, $amount);
    }

}
