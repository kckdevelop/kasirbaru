<?php

namespace App\Http\Controllers;

use App\Models\DetailPenjualan;
use Illuminate\Http\Request;
use App\Models\Pelanggan;
use App\Models\Penjualan;
use App\Models\Produk;

class KasirController extends Controller
{
    public function index()
    {
        $pelanggans = Pelanggan::get();
        $produks = Produk::get();
        $penjualans = Penjualan::get();
        $total_penjualan = penjualan::count();
        
        
        if(empty($total_penjualan))
        {
            $notas = "1000001";
        }
        else
        {
            $notasakhir = Penjualan::orderBy('id','DESC')->first()->NoNota;
            $notas = $notasakhir+1;

        }
        return view('kasir', [
            'pelanggans' => $pelanggans,
            'produks' => $produks,
            'penjualans'=>$penjualans,
            'NoNota' =>$notas,
        ]);
    }

    public function simpan(Request $request)
    {
        
        $request ->validate([
            'kasirtanggal' => 'required',
            'kasirnota' => 'required',
            'kasiridpelanggan' => 'required',
            'kasirtotal' => 'required',
            'kasirbayar' => 'required',
            'kasirkembalian' => 'required',
        ]);
        // dd($request);
        //ubah format
        $totalbelanja = hapusformat( $request->kasirtotal);
        $totalbayar = hapusformat( $request->kasirbayar);
        $kembalian = hapusformat( $request->kasirkembalian);
        Penjualan::create([
            'NoNota' => $request->kasirnota,
            'TanggalPenjualan' => $request->kasirtanggal,
            'TotalHarga' =>$totalbelanja,
            'TotalBayar' =>$totalbayar,
            'Kembalian' => $kembalian,
            'pelanggan_id' => $request->kasiridpelanggan,
        ]);

        return redirect()->route('kasir')->with('success', 'Transaksi berhasil ditambahkan!');
    }
}
