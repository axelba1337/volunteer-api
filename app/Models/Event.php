<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    // Paksa Laravel menggunakan nama tabel tunggal
    protected $table = 'event';

    // Mass assignment protection
    protected $fillable = [
        'title',
        'description',
        'event_date',
    ];

    // Cast event_date agar menjadi objek Carbon/Datetime
    protected $casts = [
        'event_date' => 'datetime',
    ];

    // Relasi Many-to-Many ke User (Kebalikan dari User)
    public function users()
    {
        return $this->belongsToMany(User::class, 'event_user', 'event_id', 'user_id')
                    ->withTimestamps();
    }
}