<?php

namespace App\Listeners;

use App\Events\KendaraanUpdated;
use App\Models\Kendaraan;

class UpdateStokKendaraan
{
    public function handle(KendaraanUpdated $event)
    {
        $stokKendaraan = Kendaraan::where('nama_kendaraan', $event->nama_kendaraan)->first();

        if ($stokKendaraan) {
            $stokKendaraan->jumlah_masuk += $event->jumlah_masuk;
            $stokKendaraan->save();
        } else {
            Kendaraan::create([
                'nama_kendaraan' => $event->nama_kendaraan,
                'jumlah_masuk' => $event->jumlah_masuk,
            ]);
        }
    }
}
