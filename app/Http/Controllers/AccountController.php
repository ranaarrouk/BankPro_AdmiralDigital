<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\AccountServiceInterface;
use App\Http\Requests\DepositRequest;
use App\Http\Requests\TransferMoneyRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

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
            return response()->json(['message' => 'Deposit Successfully', 'new_balance' => number_format(Auth::user()->account->balance, 2) . ' $']);

        } catch (\Exception $exception) {
            return response()->json(['message' => $exception->getMessage()], 422);
        }
    }

    public function transferMoney(TransferMoneyRequest $request)
    {
        try {
            DB::transaction(function () use ($request) {
                $this->accountService->transferMoney($request->validated());
            });
            return response()->json(['message' => 'Transfer Successfully', 'new_balance' => number_format(Auth::user()->account->balance, 2) . ' $']);
        } catch (\Exception $exception) {
            return response()->json(['message' => $exception->getMessage()], 422);
        }
    }
}
