<?php


namespace App\Repositories\Implementations;
use App\Models\Account;
use App\Repositories\Interfaces\AccountRepositoryInterface;
use Illuminate\Database\Eloquent\Model;


class AccountRepository extends BaseRepository implements AccountRepositoryInterface
{
    public function __construct(Account $model)
    {
        parent::__construct($model);
    }

    public function deposit(Model $model, $newBalance)
    {
        $this->update($model, ['balance' => $newBalance]);
    }
}
