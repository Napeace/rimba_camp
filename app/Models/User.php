<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    // Method untuk cek apakah user adalah admin
    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    // Method untuk cek apakah user adalah pengunjung
    public function isPengunjung()
    {
        return $this->role === 'pengunjung';
    }

    public function testimonis() {
        return $this->hasMany(Testimoni::class);
    }
}
