<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class Penjualan extends Model
{
    protected $fillable = [
        'NoNota',
        'TanggalPenjualan',
        'TotalHarga',
        'TotalBayar',
        'Kembalian',
        'pelanggan_id',
    ];
    protected $dates = ['TanggalPenjualan'];

    public function pelanggan(): BelongsTo
    {
        return $this->belongsTo(Pelanggan::class, 'pelanggan_id', 'id');
    }

    public function detailPenjualans()
    {
        return $this->hasMany(DetailPenjualan::class, 'id_penjualan', 'id');
    }
}
