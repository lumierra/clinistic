<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HasilLab extends Model
{
    use HasFactory;

    protected $table = 'hasil_lab';
    protected $guarded = [];

    public function lab()
    {
        return $this->belongsTo(Lab::class, 'lab_id');
    }
}
