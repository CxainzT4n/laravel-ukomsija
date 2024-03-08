<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kendaraan extends Model
{
    use HasFactory;

    protected $table = 'kendaraan';

    protected $fillable = [
        'nama_kendaraan', 'spesifikasi', 'kondisi', 'lokasi', 'jumlah_masuk', 'sumber_dana', 'jumlah_pinjam', 'tanggal_kembali','total_unit','jumlah_keluar','penerima_id','tanggal_keluar',
    ];

 public function kendaraan()
 {
     return $this->belongsTo(Kendaraan::class);
 }

 public function stokKendaraan()
    {
        return $this->hasOne(StokKendaraan::class, 'nama_kendaraan','nama_kendaraan');
    }
    public function pinjamKendaraan()
    {
        return $this->hasMany(PinjamKendaraan::class, 'nama_kendaraan', 'kondisi');
    }
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
