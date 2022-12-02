<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Farmasi extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'farmasi';
    protected $guarded = [];

    public function kunjungan()
    {
        return $this->belongsTo(Kunjungan::class);
    }

    public function obat()
    {
        return $this->belongsTo(Obat::class, 'obat_id');
    }

    public function pasien()
    {
        return $this->belongsTo(Pasien::class, 'pasien_id');
    }

    public function dokter()
    {
        return $this->belongsTo(Dokter::class, 'dokter_id');
    }

    public function poliklinik()
    {
        return $this->belongsTo(Poliklinik::class, 'poliklinik_id');
    }

    public function obat_pengganti()
    {
        return $this->belongsTo(Obat::class, 'obat_pengganti_id');
    }

    public function detail_farmasi_racik()
    {
        return $this->hasMany(DetailFarmasiRacik::class, 'farmasi_id');
    }
}
