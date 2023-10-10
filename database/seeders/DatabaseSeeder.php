<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $users = \App\Models\User::factory(10)->create();

        foreach ($users as $user) {
            $account = \App\Models\Account::factory()->create([
                'user_id' => $user->id,
                'number' => rand(1000000000, 9999999999),
                'balance' => 2000000
            ]);
        }

        \App\Models\Transaction::factory(10)->create();


    }
}
