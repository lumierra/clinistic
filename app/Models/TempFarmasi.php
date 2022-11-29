<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TempFarmasi extends Model
{
    use HasFactory;

    protected $table = 'temp_farmasi';
    protected $guarded = [];


    public function obat()
    {
        return $this->belongsTo(Obat::class, 'obat_id');
    }
}
