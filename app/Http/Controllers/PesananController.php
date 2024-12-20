<?php

namespace App\Http\Controllers;

use App\Models\Pesanan;
use App\Models\DetailPesanan;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class PesananController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function show($id)
    {
        // Mengambil data pesanan berdasarkan id
        $pesanan = Pesanan::where('id', $id)->firstOrFail();
    
        // Ambil data keranjang berdasarkan ID pesanan
        $keranjangItems = DetailPesanan::where('id_pesanan', $id)->with('produk')->get();
    
        return view('customer.showPelanggan', [
            'pesanan' => $pesanan,
            'keranjangItems' => $keranjangItems
        ]);
    }
    
}
?>