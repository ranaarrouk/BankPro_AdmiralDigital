<?php


namespace App\Http\Controllers;


use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Services\StoreUserService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;
use App\Services\AccountServiceInterface;

class AuthController
{
    protected StoreUserService $userService;
    protected AccountServiceInterface $accountService;

    public function __construct(StoreUserService $userService, AccountServiceInterface $accountService)
    {
        $this->userService = $userService;
        $this->accountService = $accountService;
    }

    function register(RegisterRequest $request): JsonResponse
    {
        $user = $this->userService->execute($request->validated());

        $account = $this->accountService->create($user);

        $token = $user->createToken('authToken')->plainTextToken;

        return response()->json([
            'user' => $user,
            'token' => $token,
        ], 200);
    }

    function login(LoginRequest $request)
    {
        $credentials = $request->validated();

        $remember = $credentials['remember'] ? $credentials['remember'] : false;
        unset($credentials['remember']);
        if (!Auth::attempt($credentials, $remember)) {
            return response()->json(['error' => 'Credentials are not correct'], 422);
        }

        $user = Auth::user();
        $token = $user->createToken('authToken')->plainTextToken;

        return response()->json([
            'user' => $user,
            'token' => $token,
        ], 200);
    }

    function logout(Request $request)
    {
        $user = Auth::user();
        $user->currentAccessToken()->delete();

        return response()->json([
            'success' => true,
        ], 200);
    }
}
