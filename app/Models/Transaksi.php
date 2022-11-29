<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    protected $table = 'transaksi';
    protected $guarded = [];

    public function detailTransaksi()
    {
        return $this->hasMany(DetailTransaksi::class)->orderBy('urut', 'asc');
    }
}
