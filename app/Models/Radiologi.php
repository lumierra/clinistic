<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Radiologi extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'radiologi';
    protected $guarded = [];

    public function dokter()
    {
        return $this->belongsTo(Dokter::class);
    }

    public function produk()
    {
        return $this->belongsTo(Produk::class, 'produk_rad_id');
    }

    public function hasil()
    {
        return $this->hasOne(HasilRadiologi::class, 'radiologi_id');
    }
}
