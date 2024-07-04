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
        'user_id', 'total_harga', 'payment_method',
    ];

<<<<<<< HEAD
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function pesanan()
    {
        return $this->hasMany(Pesanan::class);
=======
    public function toSearchableArray()
    {
        return [
            'nama_menu' => $this->nama_menu,
            'jumlah_pesanan' => $this->jumlah_pesanan,
            'total_harga' => $this->total_harga,
        ];
>>>>>>> 3bdad5e16c5ebd2ac7d461a2baa4249a21db6f9f
    }

    protected $table = 'transactions'; // Pastikan ini mengarah ke tabel yang benar
}
