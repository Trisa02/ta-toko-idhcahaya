<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;
    protected $table = 'barangs';
    protected $fillable = [
        'id_kategori',
        'nama_barang',
        'stok',
        'harga',
        'berat',
        'slug_barang',
        'detail',
        'gambar',
    ];
}
