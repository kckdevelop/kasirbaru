<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pelanggan;
use App\Models\Produk;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
class dashboard extends Controller
{
    public function index()
    {
        $today = Carbon::today();
        $total_pelanggan = pelanggan::count();
        $total_produk = produk::count();

        $totalTransaksi = DB::table('penjualans')
        ->whereDate('TanggalPenjualan', $today)
        ->sum('TotalHarga');

        return view('index', [
            'aktivitas' => 'dashboard',
            'total_pelanggan' => $total_pelanggan,
            'total_produk' => $total_produk,
            'totalTransaksi' => $totalTransaksi,
        ]);


    }
    public function register()
    {
        return view('index', [
            'aktivitas' => 'register'
        ]);
    }



}
