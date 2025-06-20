<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'username', 'password', 'role',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];
    public function penjualans()
    {
        return $this->hasMany(Penjualan::class, 'kasir_id');
    }
}
