<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;

    public function details()
    {
        return $this->hasMany(DetailPembelian::class, 'barang_id', 'id');
    }
}
