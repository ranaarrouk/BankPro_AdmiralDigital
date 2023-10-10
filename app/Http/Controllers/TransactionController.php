<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\DepositeRequest;
use App\Http\Requests\TransferMoneyRequest;
use App\Http\Resources\TransactionResource;
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

    public function getMyTransactions(Request $request)
    {
        try {
            $data = $this->transactionService->getUserTransactions();
            return TransactionResource::collection($data);

        } catch (\Exception $exception) {
            return response()->json(['message' => $exception->getMessage()], 500);
        }
    }

}
