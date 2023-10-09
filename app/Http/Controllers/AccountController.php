<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\AccountServiceInterface;
use App\Http\Requests\DepositRequest;
use App\Http\Requests\TransferMoneyRequest;

class AccountController extends Controller
{
    private AccountServiceInterface $accountService;

    public function __construct(AccountServiceInterface $service)
    {
        $this->accountService = $service;
    }

    public function deposit(DepositRequest $request)
    {
        try {
            $this->accountService->deposit($request->validated());

        } catch (\Exception $exception) {

        }
    }

    public function transferMoney(TransferMoneyRequest $request)
    {
        try {
            $this->accountService->transferMoney($request->validated());

        } catch (\Exception $exception) {

        }
    }
}
