<?php

namespace Database\Factories;

use App\TransactionType;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Transaction>
 */
class TransactionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'type' => TransactionType::DEPOSIT,
            'from_account_id' => rand(1,10),
            'to_account_id' => rand(1,10),
            'amount' => 3000
        ];
    }
}
