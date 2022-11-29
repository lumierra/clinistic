<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AsalRujukan extends Model
{
    use HasFactory;

    protected $table = 'asal_rujukan';
    protected $guarded = [];

    public function kategoriRujukan()
    {
        return $this->belongsTo(KategoriRujukan::class, 'kategori_rujukan_id');
    }
}
