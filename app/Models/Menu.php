<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Menu extends Model
{
    use HasFactory;

    protected $table = 'menu'; // Sesuaikan dengan nama tabel Anda

    protected $fillable = [
        'Nama_menu',
        'harga',
        'deskripsi'
    ];

    public function pesanan():HasMany
    {
        return $this->hasMany(Pesanan::class, 'id_menu');
    }
}
