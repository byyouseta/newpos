<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailPembelian extends Model
{
    use HasFactory;

    protected $fillable = [
        // Daftar kolom yang dapat diisi
        'pembelian_id', // Pastikan kolom foreign key ada
        'barang_id',
        'harga_beli',
        'jumlah',
        'subtotal'
    ];

    // Relasi banyak-ke-satu dengan Pembelian
    public function pembelian()
    {
        return $this->belongsTo(Pembelian::class);
    }

    public function barang()
    {
        return $this->belongsTo(Barang::class);
    }
}
