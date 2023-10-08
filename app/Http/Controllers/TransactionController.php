<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\DepositeRequest;
use App\Http\Requests\TransferMoneyRequest;
use App\Models\Transaction;
use App\Services\TransactionServiceInterface;
use App\Services\TransactionService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    private TransactionServiceInterface $transactionService;

    public function __construct(TransactionServiceInterface $service)
    {
        $this->transactionService = $service;
    }

    public function getMyTransactions(TransferMoneyRequest $request)
    {
        try {
            $this->transactionService->getUserTransactions(['from_account_id' => Auth::id()]);
            return response()->json(Transaction::all());

        } catch (\Exception $exception) {

        }
    }

    public function deposite(DepositeRequest $request)
    {
        try {

            $this->transactionService->deposit($request->validated());

        } catch (\Exception $exception) {

        }
    }

    public function transferMoney(TransferMoneyRequest $request)
    {
        try {

            $this->transactionService->transferMoney($request->validated());

        } catch (\Exception $exception) {

        }
    }

}
