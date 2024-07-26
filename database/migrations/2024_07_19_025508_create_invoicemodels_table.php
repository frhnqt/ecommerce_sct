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
        Schema::create('tbl_invoice', function (Blueprint $table) {
            $table->id();
            $table->string('kodeinvoice');
            $table->date('tanggal_pesanan');
            $table->string('kodepesanan');
            $table->Integer('cartid');
            $table->Integer('cekoutid');
            $table->string('status')->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_invoice');
    }
};
