<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class HasilLab extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'hasil_lab';
    protected $guarded = [];

    public function lab()
    {
        return $this->belongsTo(Lab::class, 'lab_id');
    }
}
