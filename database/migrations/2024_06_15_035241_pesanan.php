<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Jalankan migrasi.
     */
    public function up(): void
    {
        Schema::create('pesanan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_menu')->constrained('menu')->onDelete('cascade');
            $table->integer('jumlah_pesanan');
            // $table->decimal('subtotal', 8, 2);
            $table->timestamps();
        });
    }

    /**
     * Rollback migrasi.
     */
    public function down(): void
    {
        // Schema::table('pesanan', function (Blueprint $table) {
        //     $table->dropForeign(['id_menu']); // Hapus foreign key constraint berdasarkan kolom
        // });
        Schema::dropIfExists('pesanan');
    }
};
