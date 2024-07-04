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
        Schema::table('pesanan', function (Blueprint $table) {
            // $table->unsignedBigInteger('id_transaksi');
            $table->foreignId('id_transaksi')->constrained('transactions')->onDelete('cascade');
            // $table->foreign('id_transaksi')
            //     ->references('id')->on('transactions')
            //     ->onDelete('cascade'); // Aksi yang dilakukan saat data dihapus dari tabel transactions
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pesanan', function (Blueprint $table) {
            $table->dropForeign(['id_transaksi']);
            $table->dropColumn('id_transaksi');
        });
    }
};
