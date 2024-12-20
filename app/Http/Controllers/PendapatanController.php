<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use App\Models\Pesanan;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Carbon\Carbon;

class PendapatanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $interval = $request->get('interval', '7d'); // Default 1 minggu
        $pesananQuery = Pesanan::where('status', 'success');
    
        if ($interval == '1d') {
            $pesananQuery->whereDate('updated_at', now()->format('Y-m-d'));
        } elseif ($interval == '7d') {
            $pesananQuery->where('updated_at', '>=', now()->subDays(6)->startOfDay())
             ->where('updated_at', '<=', now());

        } elseif ($interval == '1m') {
            $pesananQuery->where('updated_at', '>=', now()->subMonth());
        }
    
        $pendapatan = $pesananQuery->get();
    
        // Menyiapkan data rentang waktu kosong jika tidak ada data
        $labels = [];
        if ($interval == '1d') {
            // Mendapatkan waktu sekarang
            $now = Carbon::now('Asia/Jakarta');
        
            // Mengisi label dengan format waktu "jam yang lalu"
            for ($i = 23; $i >= 0; $i--) {
                $labels[] = $now->subHours(1)->format('H') . ":00";  // Mengurangi 1 jam setiap iterasi
            }
        } elseif ($interval == '7d') {
            
            // Set locale ke Bahasa Indonesia
            Carbon::setLocale('id');
            
            // Menghasilkan label hari dari 6 hari yang lalu hingga hari ini
            $labels = [];
            for ($i = 6; $i >= 0; $i--) {
                $labels[] = Carbon::now()->subDays($i)->locale('id')->isoFormat('dddd');  // Format hari dalam Bahasa Indonesia
            }
            
        } elseif ($interval == '1m') {
            for ($i = 1; $i <= 4; $i++) {
                $labels[] = "Minggu $i";
            }
        }
    
        return view('pendapatan.pendapatan', [
            'pendapatan' => $pendapatan,
            'interval' => $interval,
            'labels' => $labels,
        ]);
    }
    
}


?>