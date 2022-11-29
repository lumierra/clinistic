<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PasienBpjs extends Model
{
    use HasFactory;

    protected $table = 'pasien_bpjs';
    protected $guarded = [];

    public function asuransi()
    {
        return $this->belongsTo(Asuransi::class, 'asuransi_id');
    }
}
