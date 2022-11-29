<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lab extends Model
{
    use HasFactory;

    protected $table = 'lab';
    protected $guarded = [];

    public function produklab()
    {
        return $this->belongsTo(ProdukLab::class, 'produk_lab_id');
    }

    public function dokter()
    {
        return $this->belongsTo(Dokter::class);
    }

    public function produk()
    {
        return $this->belongsTo(Produk::class, 'produk_lab_id');
    }

    public function hasil()
    {
        return $this->hasOne(HasilLab::class, 'lab_id');
    }

    public function pasien()
    {
        return $this->belongsTo(Pasien::class);
    }
}
