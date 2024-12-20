<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;
use App\Models\Pelanggan;
use App\Models\Pesanan;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;


class DashboardController extends Controller
{
    public function index(Request $request)
    {
        // Jumlah total barang (jumlah record di tabel produk)
        $jumlahBarang = Produk::count();

        // Total stok barang (menjumlahkan nilai kolom 'stock')
        $totalStok = Produk::sum('stock');

        // Jumlah pelanggan
        $jumlahPelanggan = Pelanggan::count();

        $currentMonth = Carbon::now()->month; // Mengambil bulan saat ini
        $currentYear = Carbon::now()->year;   // Mengambil tahun saat ini
        
        $jumlahPesanan = Pesanan::where('status', 'success')
            ->whereMonth('updated_at', $currentMonth)
            ->whereYear('updated_at', $currentYear)
            ->sum('total_harga');
        
        $pesanan = Pesanan::where('status', 'success')
        ->orderBy('id', 'desc')
        ->get();
        
        
        return view('dashboard.dashboard', [
            'jumlahBarang' => $jumlahBarang,
            'totalStok' => $totalStok,
            'jumlahPelanggan' => $jumlahPelanggan,
            'jumlahPesanan' => $jumlahPesanan,
            'pesanan' => $pesanan,
        ]);
    }


}
