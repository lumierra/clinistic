<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kunjungan extends Model
{
    use HasFactory;

    protected $table = 'kunjungan';
    protected $guarded = [];

    public function pasien()
    {
        return $this->belongsTo(Pasien::class, 'pasien_id');
    }

    public function antrian()
    {
        return $this->hasOne(Antrian::class, 'kunjungan_id', 'id');
    }

    public function poliklinik()
    {
        return $this->belongsTo(Poliklinik::class, 'poliklinik_id');
    }

    public function dokter()
    {
        return $this->belongsTo(Dokter::class, 'dokter_id');
    }

    public function asuransi()
    {
        return $this->belongsTo(Asuransi::class, 'asuransi_id');
    }

    public function diagnosa()
    {
        return $this->hasOne(Diagnosa::class);
    }

    public function diagnosas()
    {
        return $this->hasMany(Diagnosa::class);
    }

    public function farmasi()
    {
        return $this->hasOne(Farmasi::class, 'kunjungan_id');
    }

    public function farmasis()
    {
        return $this->hasMany(Farmasi::class, 'kunjungan_id');
    }

    public function lab()
    {
        return $this->hasOne(Lab::class);
    }

    public function lab2()
    {
        // return $this->hasOne(Lab::class)->where('tgl_order', date('Y-m-d'));
        return $this->hasOne(Lab::class);
    }

    public function labs2()
    {
        return $this->hasMany(Lab::class);
    }

    public function labs()
    {
        return $this->hasMany(Lab::class);
    }

    public function radiologi()
    {
        return $this->hasOne(Radiologi::class);
    }

    public function radiologis()
    {
        return $this->hasMany(Radiologi::class);
    }

    public function catatan()
    {
        return $this->hasOne(Catatan::class);
        // return $this->hasOne(Catatan::class, 'kunjungan_id', 'kunjungan_id');
        // return $this->belongsTo(Catatan::class, 'kunjungan_id');
    }

    public function detailTindakan()
    {
        return $this->hasMany(DetailTindakan::class);
    }

    public function getAlergi($kunjungan, $alergi)
    {
        if ($alergi == 'makanan'){

        } else if ($alergi == 'udara'){

        } else {
            $data = Catatan::where('kunjungan_id', $kunjungan)->first();
            // dd($data);
            if ($data == null){
                return '-';
            } else {
                return $data->alergi_obat;
            }
        }
    }

    public function transaksi()
    {
        return $this->hasOne(Transaksi::class, 'kunjungan_id', 'id');
    }

    public function foto_estetika()
    {
        return $this->hasMany(FotoEstetika::class, 'kunjungan_id', 'id');
    }

    // public function getDate($id)
    // {
    //     $date = Berita::find($id);
    //     return Carbon::parse($date->tanggal_berita)->translatedFormat('l, d F Y');
    // }
}
