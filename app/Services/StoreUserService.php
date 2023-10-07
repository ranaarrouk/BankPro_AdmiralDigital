<?php


namespace App\Services;

use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Models\User;

class StoreUserService
{
    private UserRepositoryInterface $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function execute(array $userData)
    {
        $user = $this->userRepository->create($userData);
        return $user->refresh();
    }
}
