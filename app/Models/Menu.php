<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    protected $table = 'menu'; // Sesuaikan dengan nama tabel Anda

    protected $fillable = [
        'Nama_menu',
        'harga',
        'deskripsi'
    ];

    public function pesanan()
    {
        return $this->hasMany(Pesanan::class, 'id_menu');
    }
}
