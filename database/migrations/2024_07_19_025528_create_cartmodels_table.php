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
        Schema::create('tbl_cart', function (Blueprint $table) {
            $table->id();
            $table->Integer('product_id');
            $table->Integer('user_id');
            $table->decimal('totalbelanja', 10, 2);
            $table->Integer('quantity')->default(0);
            $table->string('status_cart')->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_cart');
    }
};
