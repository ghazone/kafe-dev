<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_menu', 'jumlah_pesanan', 'total_harga', 'payment_method',
    ];

    protected $table = 'transactions'; // Pastikan ini mengarah ke tabel yang benar
}
