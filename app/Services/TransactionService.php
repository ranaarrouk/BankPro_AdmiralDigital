<?php


namespace App\Services;


use App\Models\Account;
use App\TransactionType;
use Illuminate\Database\Eloquent\Model;
use App\Repositories\Interfaces\TransactionRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Pagination\LengthAwarePaginator;

class TransactionService implements TransactionServiceInterface
{

    private TransactionRepositoryInterface $transactionRepository;

    /**
     * TransactionService constructor.
     * @param TransactionRepositoryInterface $transactionRepository
     */
    public function __construct(TransactionRepositoryInterface $transactionRepository)
    {
        $this->transactionRepository = $transactionRepository;
    }

    /**
     * Get user transactions deposit, and transfer (where he is the sender or recipient)
     * @return LengthAwarePaginator
     */
    public function getUserTransactions(): LengthAwarePaginator
    {
        $conditions = [
            ['from_account_id', '=', Auth::id()],
            ['to_account_id', '=', Auth::id()],
        ];
        //Get user transactions deposit, and transfer (where he is the sender OR recipient)
        return $this->transactionRepository->whereOrWhere($conditions, ['*'], ['senderAccount.user', 'recipientAccount.user'], true, 5);
    }

    /**
     * Create new transaction to save Deposit transaction
     * @param Account $account
     * @param $amount
     * @return Model
     */
    public function createDepositTransaction(Account $account, $amount): Model
    {
        $this->fillAttributes($attributes, TransactionType::DEPOSIT, $account, $account, $amount);
        return $this->transactionRepository->create($attributes);
    }

    /**
     * Create new transaction to save Transfer transaction
     * @param Account $from
     * @param Account $to
     * @param $amount
     * @return Model
     */
    public function createTransferTransaction(Account $from, Account $to, $amount): Model
    {
        $this->fillAttributes($attributes, TransactionType::TRANSFER, $from, $to, $amount);
        return $this->transactionRepository->create($attributes);
    }

    /**
     * @param $attributes
     * @param $type
     * @param Account $from
     * @param Account $to
     * @param $amount
     */
    private function fillAttributes(&$attributes, $type, Account $from, Account $to, $amount)
    {
        $attributes['type'] = $type;
        $attributes['from_account_id'] = $from->id;
        $attributes['to_account_id'] = $to->id;
        $attributes['amount'] = $amount;
    }
}
