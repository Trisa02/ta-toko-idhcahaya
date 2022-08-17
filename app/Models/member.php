<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class member extends Model
{
    use HasFactory;
    protected $table ='members';
    // protected $primaryKey = 'id';
    protected $fillable = [
        'nama_member',
        'username_member',
        'password',
        'email_member',
        'no_telepon',
        'province_destination',
        'city_destination',
        'alamat_member',
        'gambar',
    ];
}
