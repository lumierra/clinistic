<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Poliklinik extends Model
{
    use HasFactory;

    protected $table = 'poliklinik';
    protected $guarded = [];

    public function dokterpoli()
    {
        return $this->hasMany(DokterPoliklinik::class, 'poliklinik_id', 'id');
    }

    public function getPasien()
    {
        $kunjungan = Kunjungan::where('tgl_masuk', date('Y-m-d'))
                            ->where('poliklinik_id', $this->id)
                            ->get()->count();
        return $kunjungan;
    }



    public function getPasienByDate($tanggal)
    {
        $tanggal = date('Y-m-'.$tanggal);
        $kunjungan = Kunjungan::where('tgl_masuk', $tanggal)
                            ->where('poliklinik_id', $this->id)
                            ->get()->count();
        return $kunjungan;
    }

    public function antrian()
    {
        return $this->hasOne(Antrian::class, 'poliklinik_id', 'id');
    }

    public function getAntrian()
    {
        $antrian = Antrian::where('poliklinik_id', $this->id)
                            ->where('status', 'menunggu')
                            ->where('tanggal', date('Y-m-d'))
                            ->get()->count();
        return $antrian;
    }
    public function getNomorAntrian()
    {
        $antrian = Antrian::select('nomor_antrian')->where('poliklinik_id', $this->id)
                            ->where('panggil', 0)
                            ->where('tanggal', date('Y-m-d'))
                            ->orderBy('id', 'asc')
                            ->first();
        if ($antrian){
            return $antrian->nomor_antrian;
        }
        else{
            $antrian = Antrian::select('nomor_antrian')->where('poliklinik_id', $this->id)->where('tanggal', date('Y-m-d'))->get()->count();
            if ($antrian == 0){
                return '-';
            } else {
                return 'SELESAI';
            }
        }
    }

    // DOKTER
    public function getPasienByDokter($dokter)
    {
        $kunjungan = Kunjungan::where('tgl_masuk', date('Y-m-d'))
                            ->where('poliklinik_id', $this->id)
                            ->where('dokter_id', $dokter)
                            ->get()->count();
        return $kunjungan;
    }
    public function getNomorAntrianByDokter($dokter)
    {
        $antrian = Antrian::select('nomor_antrian')->where('poliklinik_id', $this->id)
                            ->where('dokter_id', $dokter)
                            ->where('panggil', 0)
                            ->where('tanggal', date('Y-m-d'))
                            ->orderBy('id', 'asc')
                            ->first();
        if ($antrian){
            return $antrian->nomor_antrian;
        }
        else{
            $antrian = Antrian::select('nomor_antrian')->where('poliklinik_id', $this->id)->where('dokter_id', $dokter)->where('tanggal', date('Y-m-d'))->get()->count();
            if ($antrian == 0){
                return '-';
            } else {
                return 'SELESAI';
            }
        }
    }
}
