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
    Schema::create('tbl_product', function (Blueprint $table) {
        $table->id();
        $table->string('kodeproduct');
        $table->string('namaproduct');
        $table->integer('stok');
        $table->Integer('merkid');
        $table->Integer('categoryid');
        $table->decimal('harga', 10, 2);
        $table->text('deskripsi');
        $table->string('gambar');
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_product');
    }
};
