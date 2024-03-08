<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PinjamKendaraan extends Model
{
    use HasFactory;

    protected $table = 'peminjaman_kendaraan';
    protected $fillable = ['peminjam', 'nama_kendaraan', 'kondisi', 'jumlah_pinjam', 'tanggal_kembali'];

    public function kendaraan()
    {
        return $this->belongsTo(Kendaraan::class, 'nama_kendaraan', 'kondisi');
    }
    
    
}
