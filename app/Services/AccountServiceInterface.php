<?php


namespace App\Services;


use App\Models\Account;
use App\Models\User;

interface AccountServiceInterface
{
    public function create(User $user);

    public function deposit($amount) : void;

    public function transferMoney($data) : void;
}
