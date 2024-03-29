<?php

namespace App\Http\Controllers;

use App\Models\PinjamKendaraan;
use App\Models\Kendaraan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB; 

class DataPeminjamanUserController extends Controller
{
    public function indexUser() {
        $user = Auth::user();
        $data = Kendaraan::all();
        return view('DashboardUser.index', ['data' => $data, 'user' => $user]);
    }

    public function tabelPeminjaman() {
        $dataKendaraan = Kendaraan::all();
        return view('DashboardUser.tabelPeminjaman',['dataKendaraan'=>$dataKendaraan]);
    }

    public function pinjamKendaraan($id) {
        $dataKendaraan = Kendaraan::with('user')->findOrFail($id);

    if ($dataKendaraan->user) {
        $penerima = $dataKendaraan->user->name;
    } else {
        $penerima = 'Unknown User';
    }

        return view('DashboardUser.formPinjam',compact('dataKendaraan','penerima'));
    }
   
    
    public function storePinjam(Request $request, $id)
{
    $request->validate([
        'jumlah_pinjam' => 'required|numeric|min:1',
        'tanggal_kembali' => 'required|date',
    ]);

    $kendaraan = Kendaraan::find($id);

    if (!$kendaraan) {
        return redirect()->route('peminjaman.user')->with('error', 'Kendaraan not found.');
    }

    if ($kendaraan->jumlah_masuk < $request->jumlah_pinjam) {
        return redirect()->route('peminjaman.user')->with('error', 'Stok kendaraan tidak mencukupi.');
    }

    $kendaraan->update([
        'jumlah_pinjam' => $kendaraan->jumlah_pinjam + $request->jumlah_pinjam,
        'jumlah_masuk' => $kendaraan->jumlah_masuk - $request->jumlah_pinjam,
        'total_unit' => $kendaraan->jumlah_masuk - ($kendaraan->jumlah_pinjam + $request->jumlah_pinjam),
        'tanggal_kembali' => $request->tanggal_kembali,
    ]);

    return redirect()->route('peminjaman.user')->with('success', 'Data peminjaman kendaraan berhasil disimpan.');
}





    
    
    
}
