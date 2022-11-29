<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $guarded = [];
    // protected $fillable = [
    //     'name',
    //     'email',
    //     'password',
    // ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function dokter()
    {
        return $this->belongsTo(Dokter::class);
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public function hasAnyRoles($roles)
    {
        if ($this->roles()->whereIn('name', $roles)->first()) {
            return true;
        }

        return false;
    }

    public function hasRole($role)
    {
        if ($this->roles()->where('name', $role)->first()) {
            return true;
        }

        return false;
    }

    public function role()
    {
        return $this->belongsTo(Role::class);
    }
    public function getRole($role)
    {
        return $this->role()->where('name', $role)->first();
    }
    public function getAnyRole($role)
    {
        return $this->role()->whereIn('name', $role)->first();
    }

    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }

    // public function getCoba($hari)
    // {
    //     $date = Carbon::createFromDate(date('Y'), date('m'), $hari)->format('Y-m-d');
    //     $data = Data::where('tanggal', $date)->get()->count();
    //     // return $data;
    //     return rand(5,15);
    // }

    public function isRole()
    {
        return $this->role();
    }


    public function submenus()
    {
        return $this->belongsToMany(Submenu::class);
    }

    public function menuuser()
    {
        return $this->hasMany(MenuUser::class);
    }

    public function getMenu()
    {
        return $this->menuuser()->where('user_id', $this->id)->orderBy('menu_id')->get();
    }

    public function getAllMenu()
    {
        return Menu::where('status', 'aktif')->orderBy('urut', 'asc')->get();
    }

    public function gender()
    {
        return $this->belongsTo(Gender::class);
    }
}
