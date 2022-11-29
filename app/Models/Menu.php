<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    protected $table = 'menu';
    protected $guarded = [];

    public function submenu()
    {
        return $this->hasMany(Submenu::class, 'menu_id', 'id')->orderBy('urut', 'asc');
    }

    public function menuuser()
    {
        return $this->hasMany(MenuUser::class, 'menu_id', 'id');
    }

    public function getSubmenu()
    {
        return MenuUser::where('menu_id', $this->id)->get();
    }

    public function cekMenu()
    {
        return MenuUser::where('menu_id', $this->id)->where('user_id', auth()->user()->id)->first();
    }
}
