<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Log;

class BackupController extends Controller
{
    public function backupNow()
    {
        try {
            // Jalankan perintah backup
            Artisan::queue('backup:run');
            $output = Artisan::output();

            // Log hasil
            Log::info("Backup berhasil: " . $output);

            return redirect()->back()->with('success', 'Backup berhasil dijalankan!');
        } catch (\Exception $e) {
            // Log error
            Log::error("Backup gagal: " . $e->getMessage());

            return redirect()->back()->with('error', 'Backup gagal dijalankan. Silakan coba lagi.');
        }
    }
}
