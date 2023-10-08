<?php


namespace App\Providers;


use App\Repositories\Implementations\AccountRepository;
use App\Repositories\Implementations\TransactionRepository;
use App\Repositories\Implementations\UserRepository;
use App\Repositories\Interfaces\AccountRepositoryInterface;
use App\Repositories\Interfaces\TransactionRepositoryInterface;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Services\TransactionService;
use App\Services\TransactionServiceInterface;
use Illuminate\Support\ServiceProvider;

class DALServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $toBind = [
            UserRepositoryInterface::class => UserRepository::class,
            AccountRepositoryInterface::class => AccountRepository::class,
            TransactionRepositoryInterface::class => TransactionRepository::class,
            TransactionServiceInterface::class => TransactionService::class,
        ];

        foreach ($toBind as $interface => $implementation) {
            $this->app->bind($interface, $implementation);
        }
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
