<?php


namespace App\Http\Controllers;


use App\Exceptions\InvalidCredentialsException;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Resources\ErrorResource;
use App\Http\Resources\UserResource;
use App\Services\StoreUserService;
use Illuminate\Support\Facades\Auth;
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

    function register(RegisterRequest $request): UserResource
    {
        // Create new user
        $user = $this->userService->execute($request->validated());

        // Create new bank account for the user
        $this->accountService->create($user);

        return new UserResource($user);

    }

    function login(LoginRequest $request)
    {
        $credentials = $request->validated();

        try {
            if (!Auth::attempt($credentials)) {
                throw new InvalidCredentialsException();
            }

        } catch (InvalidCredentialsException $exception) {
            return response(new ErrorResource($exception), $exception->getCode());

        }

        $user = Auth::user();

        return new UserResource($user);
    }
}
