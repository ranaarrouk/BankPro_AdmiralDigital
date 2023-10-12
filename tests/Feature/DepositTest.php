<?php

namespace Tests\Feature;

use App\Http\Requests\DepositRequest;
use App\Models\Account;
use App\Models\User;
use App\Repositories\Implementations\AccountRepository;
use App\Services\TransactionService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DepositTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        // Mock the AccountRepository
        $accountRepository = $this->mock(AccountRepository::class);
        $accountRepository->shouldReceive('deposit');

        // Mock the TransactionService
        $transactionService = $this->mock(TransactionService::class);
        $transactionService->shouldReceive('createDepositTransaction');

        // Create a user and a request
        $user = User::factory()->createOne();
        $account = \App\Models\Account::factory()->create([
            'user_id' => $user->id,
            'number' => rand(1000000000, 9999999999),
            'balance' => 0
        ]);

        $request = DepositRequest::create('/api/deposit', 'POST', ['amount' => 100]);

        // Authenticate the user
        $this->actingAs($user);

        // Call the deposit function
        $response = $this->post('/api/deposit', $request->all());

        // Assert that the response is correct
        $response->assertJson([
            'message' => 'Deposit Successfully',
        ]);

        $this->assertDatabaseHas('accounts', [
            'id' => $user->account->id,
            'balance' => 100.00,
        ]);
    }
}
