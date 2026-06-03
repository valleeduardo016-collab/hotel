<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Hotel;
use App\Models\Reservation;

class Room extends Model
{
    use HasFactory;

    protected $fillable = [
        'hotel_id',
        'type',
        'price',
        'available',
        'image'
    ];

   //Relaciones
  

    // Una habitación pertenece a un hotel
   public function hotel()
{
    return $this->belongsTo(Hotel::class);
}

    // Una habitación puede tener muchas reservas
    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }
}