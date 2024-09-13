<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembelian extends Model
{
    use HasFactory;

    public function details()
    {
        return $this->hasMany(DetailPembelian::class);
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }
}
