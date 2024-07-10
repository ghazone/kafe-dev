<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Pesanan extends Model
{
    use HasFactory;

    protected $table = 'pesanan';
    protected $fillable = [
        'id_menu',
        'id_transaksi',
        'jumlah_pesanan',
    ];

    public function menu():BelongsTo
    {
        return $this->belongsTo(Menu::class, 'id_menu');
    }

    public function transaction():BelongsTo
    {
        return $this->belongsTo(Transaction::class, 'id_transaksi');
    }
}
