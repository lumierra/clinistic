<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailFarmasiRacik extends Model
{
    use HasFactory;

    protected $table = 'detail_farmasi_racik';
    protected $guarded = [];

    public function obat()
    {
        return $this->belongsTo(Obat::class, 'obat_id');
    }
}
