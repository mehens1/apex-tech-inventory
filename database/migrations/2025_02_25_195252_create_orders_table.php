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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('set null');
            $table->string('email');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('shipping_address');
            $table->string('phone');
            $table->string('payment_method');
            $table->decimal('total_amount', 10, 2);
            $table->decimal('vat', 10, 2);
            $table->string('discount_code')->nullable();
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
