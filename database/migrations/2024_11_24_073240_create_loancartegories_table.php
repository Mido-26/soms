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
        Schema::create('loanCartegories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('loanName');
            $table->decimal('minAmount',15,2)->default(2);
            $table->decimal('maxAmount',15,2)->default(2);
            $table->integer('interest');
            $table->integer('dueDatedays');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('loancartegories');
    }
};
