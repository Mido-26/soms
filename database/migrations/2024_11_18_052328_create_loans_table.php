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
        Schema::create('loans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('loans_category_id')->constrained('loans_cartegories')->onDelete('cascade');
            $table->integer('duration_in_days'); // Store duration in days
            $table->decimal('amount', 10, 2); // Loan amount
            $table->decimal('interest_rate', 5, 2); // Interest rate as percentage
            $table->enum('status', ['pending', 'approved', 'rejected', 'disbursed', 'completed', 'defaulted'])->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('loans');
    }
};
