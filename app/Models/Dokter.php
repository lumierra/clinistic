<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Dokter extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'dokter';
    protected $guarded = [];

    public function poliklinik()
    {
        return $this->belongsTo(Poliklinik::class);
    }

    public function gender()
    {
        return $this->belongsTo(Gender::class);
    }

    public function kecamatan()
    {
        return $this->belongsTo(Kecamatan::class);
    }

    public function kota()
    {
        return $this->belongsTo(Kota::class);
    }

    public function provinsi()
    {
        return $this->belongsTo(Provinsi::class);
    }

    public function dokterpoli()
    {
        return $this->hasMany(DokterPoliklinik::class, 'dokter_id', 'id');
    }
}
