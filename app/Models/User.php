<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens; // Tambahkan ini untuk Auth API

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    // Paksa Laravel menggunakan nama tabel tunggal
    protected $table = 'user';

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // Relasi Many-to-Many ke Event
    public function events()
    {
        return $this->belongsToMany(Event::class, 'event_user', 'user_id', 'event_id')
                    ->withTimestamps(); // Menghandle created_at & updated_at di tabel pivot
    }
}