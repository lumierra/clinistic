<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DokterPoliklinik extends Model
{
    use HasFactory;

    protected $table = 'dokter_poliklinik';
    protected $guarded = [];

    public function poliklinik()
    {
        return $this->belongsTo(Poliklinik::class);
    }

    public function dokter()
    {
        return $this->belongsTo(Dokter::class);
    }
}
