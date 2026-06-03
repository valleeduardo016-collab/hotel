<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hotel extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'address',
        'telefono',
        'email',
        'image',
        'admin_id', // puede ser null al inicio
    ];

   // Relaciones
   

    // Admin del hotel
   public function admin()
{
    return $this->belongsTo(User::class, 'admin_id');
}

    // Habitaciones del hotel
    public function rooms()
    {
        return $this->hasMany(Room::class);
    }
}