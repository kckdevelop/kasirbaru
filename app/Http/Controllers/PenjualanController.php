<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Penjualan;
use App\Models\DetailPenjualan;

class PenjualanController extends Controller
{
    public function index() {
        $penjualan = Penjualan::with('pelanggan')->get();
        
        return view('index', [
            'aktivitas' => 'transaksi',
            'penjualans' => $penjualan,
            
        ]);
    }

    
}
