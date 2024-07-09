<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{
    use HasFactory;

    protected $table = 'pesanan';
    protected $fillable = [
        'id_menu',
        'id_transaksi',
        'jumlah_pesanan',
    ];

    public function menu()
    {
        return $this->belongsTo(Menu::class, 'id_menu');
    }

    public function transaction()
    {
        return $this->belongsTo(Transaction::class, 'id_transaksi');
    }
}
