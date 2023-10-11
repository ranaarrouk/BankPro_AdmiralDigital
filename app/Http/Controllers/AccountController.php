<?php

namespace App\Http\Controllers;

use App\Exceptions\InsufficientBalanceException;
use App\Exceptions\InvalidAccountNumberException;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Services\AccountServiceInterface;
use App\Http\Requests\DepositRequest;
use App\Http\Requests\TransferMoneyRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use function Symfony\Component\HttpFoundation\Tests\Session\Storage\Handler\rollBack;

class AccountController extends Controller
{
    private AccountServiceInterface $accountService;

    /**
     * AccountController constructor.
     * @param AccountServiceInterface $service
     */
    public function __construct(AccountServiceInterface $service)
    {
        $this->accountService = $service;
    }

    /**
     * @param DepositRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function deposit(DepositRequest $request): JsonResponse
    {
        try {

            DB::transaction(function () use ($request) {
                $this->accountService->deposit($request->validated());
            });

            return response()->json(['message' => 'Deposit Successfully', 'new_balance' => number_format(Auth::user()->account->balance, 2) . ' $']);

        } catch (\Exception $exception) {
            DB::rollBack();
            return response()->json(['message' => $exception->getMessage()], 422);
        }
    }

    /**
     * @param TransferMoneyRequest $request
     * @return JsonResponse
     */
    public function transferMoney(TransferMoneyRequest $request): JsonResponse
    {
        try {

            DB::transaction(function () use ($request) {
                $this->accountService->transferMoney($request->validated());
            });

            return response()->json(['message' => 'Transfer Successfully', 'new_balance' => number_format(Auth::user()->account->balance, 2) . ' $']);

        } catch (InvalidAccountNumberException $exception) {
            DB::rollBack();
            return response()->json(['message' => $exception->getMessage()], 422);
        } catch (InsufficientBalanceException $exception) {
            DB::rollBack();
            return response()->json(['message' => $exception->getMessage()], 422);
        } catch (\Exception $exception) {
            DB::rollBack();
            return response()->json(['message' => 'Something went wrong'], 422);
        }
    }
}
