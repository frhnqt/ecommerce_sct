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
        Schema::create('tbl_pesanan', function (Blueprint $table) {
            $table->id();
            $table->Integer('product_id');
            $table->Integer('cart_id');
            $table->Integer('user_id');
            $table->date('tanggal_pesanan');
            $table->string('kodepesanan', 50)->unique();
            $table->string('status_pesanan')->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_pesanan');
    }
};
