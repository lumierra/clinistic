<?php

namespace App\Models;

use Carbon\Carbon;
use DateTime;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pasien extends Model
{
    use HasFactory;

    protected $table = 'pasien';
    protected $guarded = [];

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

    public function kelurahan()
    {
        return $this->belongsTo(Kelurahan::class);
    }

    public function pekerjaan()
    {
        return $this->belongsTo(Pekerjaan::class);
    }

    public function getTTL()
    {
        return $this->tempat_lahir . ', ' . date('d', strtotime($this->tgl_lahir)) . ' ' . $this->getMonth($this->tgl_lahir);
    }

    public function getGender()
    {
        return $this->gender->jenis_kelamin . ' / ' . Carbon::parse($this->tgl_lahir)->age . 'Thn';
    }

    protected function getMonth($date)
    {
        $month = new DateTime($date);
        $month = $month->format('F');
        $result = $this->month($month) . ' ' . date('Y', strtotime($date));
        return $result;
    }

    protected function month($month)
    {
        $data = [
            'January' => 'Januari',
            'February' => 'Februari',
            'March' => 'Maret',
            'April' => 'April',
            'May' => 'Mei',
            'June' => 'Juni',
            'July' => 'Juli',
            'August' => 'Agustus',
            'September' => 'September',
            'October' => 'Oktober',
            'November' => 'November',
            'December' => 'Desember'
        ];
        return $data[$month];
    }

    public function getBpjs($pasien)
    {
        $data = PasienBpjs::where('pasien_id', $pasien)->where('asuransi_id', 1)->first();
        if ($data){
            return $data->nomor;
        } else {
            return '-';
        }
    }
}
