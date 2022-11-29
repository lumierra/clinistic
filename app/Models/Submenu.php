<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Submenu extends Model
{
    use HasFactory;

    protected $table = 'submenu';
    protected $guarded = [];

    public function menu()
    {
        return $this->belongsTo(Menu::class);
    }

    public function cekSubmenu()
    {
        return MenuUser::where('submenu_id', $this->id)->where('user_id', auth()->user()->id)->first();
    }

    public function submenudetail()
    {
        return $this->hasMany(SubmenuDetail::class, 'submenu_id', 'id')->orderBy('urut', 'asc');
    }
}
