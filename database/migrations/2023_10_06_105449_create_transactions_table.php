<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->enum('type', ['Deposit', 'Withdrawal', 'Transfer']);
            $table->foreignIdFor(\App\Models\User::class, 'from_user_id');
            $table->foreignIdFor(\App\Models\User::class, 'to_user_id');
            $table->decimal('amount', 10, 2); // 10 total digits, 2 decimal places
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
