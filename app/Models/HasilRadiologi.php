<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class HasilRadiologi extends Model
{
    use HasFactoryl, SoftDeletes;

    protected $table = 'hasil_radiologi';
    protected $guarded = [];
}
