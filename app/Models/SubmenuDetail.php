<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubmenuDetail extends Model
{
    use HasFactory;

    protected $table = 'submenu_detail';
    protected $guarded = [];

    public function submenu()
    {
        return $this->belongsTo(Submenu::class, 'submenu_id', 'id');
    }
}
