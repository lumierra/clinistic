<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Catatan extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'catatan';
    protected $guarded = [];

    public function dokter()
    {
        return $this->belongsTo(Dokter::class, 'dokter_id');
    }

    public function pasien()
    {
        return $this->belongsTo(Pasien::class, 'pasien_id');
    }

    public function getDiagnosa($kunjungan)
    {
        $diagnosa = Diagnosa::where('kunjungan_id', $kunjungan)->first();
        return $diagnosa->diagnosa;
    }
}
