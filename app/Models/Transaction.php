<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Laravel\Scout\Searchable;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'total_harga', 'payment_method',
    ];

    public function user():BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function pesanan():HasMany
    {
        return $this->hasMany(Pesanan::class, 'id_transaksi');
    }

    protected $table = 'transactions'; // Pastikan ini mengarah ke tabel yang benar
}
