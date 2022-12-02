<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Diagnosa extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'diagnosa';
    protected $guarded = [];

    public function icd()
    {
        return $this->belongsTo(Icd::class, 'icd_id');
    }

    public function getCountIcd($dokter)
    {
        return $this->where('dokter_id', $dokter)->where('icd_id', $this->icd_id)->count();
    }

}
