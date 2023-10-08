<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\DepositeRequest;
use App\Http\Requests\TransferMoneyRequest;
use App\Services\TransactionServiceInterface;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    private TransactionService $transactionService;

    public function __construct(TransactionServiceInterface $service)
    {
        $this->transactionService = $service;
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
