<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kendaraan;
use App\Models\PinjamKendaraan;
use App\Models\StokKendaraan;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB; 

class DataPeminjamanController extends Controller
{
    public function index() {
        $user = Auth::user();
        $data = Kendaraan::all();
        return view('DashboardAdmin.index', ['data' => $data, 'user' => $user]);
    }

    public function tabelKendaraan() {
        $dataKendaraan = Kendaraan::all(); 
        return view('DashboardAdmin.tabelBarang', ['dataKendaraan' => $dataKendaraan]);
    }

    public function tambahKendaraan() {
        return view('DashboardAdmin.tambahBarang');
    }

    public function historyKendaraan() {
        $dataMasuk = Kendaraan::all(); 
        return view('DashboardAdmin.historyBarang',['dataMasuk' => $dataMasuk]);
    }

    public function keluarKendaraan($id) {
        $keluar = Kendaraan::findOrFail($id);
        return view('DashboardAdmin.keluarBarang',compact('keluar'));
    }
    public function prosesKeluar(Request $request, $id) {
        $request->validate([
            'jumlah_keluar' => 'required|numeric|min:1',
        ]);
    
        $kendaraan = Kendaraan::find($id);
    
        if (!$kendaraan) {
            return redirect()->route('peminjaman.user')->with('error', 'Kendaraan not found.');
        }
    
        if ($kendaraan->jumlah_masuk < $request->jumlah_keluar) {
            return redirect()->route('peminjaman.user')->with('error', 'Stok kendaraan tidak mencukupi.');
        }
    
        $kendaraan->update([
            'jumlah_keluar' => $kendaraan->jumlah_keluar + $request->jumlah_keluar,
            'jumlah_masuk' => $kendaraan->jumlah_masuk - $request->jumlah_keluar,
            'total_unit' => $kendaraan->jumlah_masuk - ($kendaraan->jumlah_keluar + $request->jumlah_keluar),
          
        ]);
    
        return redirect()->route('peminjaman.user')->with('success', 'Data peminjaman kendaraan berhasil disimpan.');
    }
    

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama_kendaraan' => 'required|string',
            'spesifikasi' => 'required|string',
            'kondisi' => 'required|string',
            'lokasi' => 'required|string',
            'jumlah_masuk' => 'required|integer',
            'sumber_dana' => 'required|numeric',
        ]);
        
        $kendaraan = Kendaraan::updateOrCreate(
            [
                'nama_kendaraan' => $request->nama_kendaraan,
                'spesifikasi' => $request->spesifikasi,
                'kondisi' => $request->kondisi,
                'lokasi' => $request->lokasi,
                'sumber_dana' => $request->sumber_dana,
            ],
            ['jumlah_masuk' => DB::raw('jumlah_masuk + ' . $request->jumlah_masuk)]
        );
    
        $kendaraan->update([
            'total_unit' => DB::raw('jumlah_masuk - jumlah_pinjam'),
        ]);

       
        return redirect()->route('tabel.peminjaman')->with('success', 'Data berhasil ditambahkan!');
    }

  
 

    public function edit($id)
    {
    $kendaraan = Kendaraan::findOrFail($id);

    return view('DashboardAdmin.editBarang', compact('kendaraan'));
    }

    public function update(Request $request, $id)
    {
    $validatedData = $request->validate([
        'nama_kendaraan' => 'required|string',
        'spesifikasi' => 'required|string',
        'kondisi' => 'required|string',
        'lokasi' => 'required|string',
        'jumlah_masuk' => 'required|integer',
        'sumber_dana' => 'required|numeric',
    ]);
    $kendaraan = Kendaraan::findOrFail($id);

    $kendaraan->update($validatedData);

    return redirect()->route('tabel.peminjaman')->with('success', 'Data berhasil diubah!');
    }
}
