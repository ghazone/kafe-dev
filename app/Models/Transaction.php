<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Transaction extends Model
{
    use HasFactory;

    use Searchable;

    protected $fillable = [
        'nama_menu', 'jumlah_pesanan', 'total_harga', 'payment_method',
    ];

    public function toSearchableArray()
    {
        return [
            'nama_menu' => $this->nama_menu,
            'jumlah_pesanan' => $this->jumlah_pesanan,
            'total_harga' => $this->total_harga,
        ];
    }

    protected $table = 'transactions'; // Pastikan ini mengarah ke tabel yang benar
}
