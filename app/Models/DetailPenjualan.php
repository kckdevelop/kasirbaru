<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailPenjualan extends Model
{

    protected $primaryKey = 'idDetail';

    protected $fillable = ['produk_id', 'JumlahProduk', 'JumlahTotal', 'penjualan_id'];


    public function produk()
    {
        return $this->belongsTo(Produk::class, 'produk_id', 'produk_id');
    }
}
