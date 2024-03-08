<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StokKendaraan extends Model
{
    use HasFactory;

    protected $table = 'stok_kendaraan';

    protected $fillable = [
        'nama_kendaraan', 'jumlah_masuk', 'jumlah_keluar', 'total_unit',
    ];

    // Add this relation to kendaraan
    public function kendaraan()
    {
        return $this->belongsTo(Kendaraan::class, 'nama_kendaraan','nama_kendaraan');
    }
}

