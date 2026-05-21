<?php

namespace App\Models;

use Database\Factories\UserFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use App\Models\Hotel;
use App\Models\Reservation;

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

  //Atributos
   

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

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
//Relaciones
   

    // Un usuario puede administrar un hotel (admin_hotel)
public function hotel()
{
    return $this->hasOne(Hotel::class, 'admin_id');
}
    // Un usuario puede tener muchas reservas
    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }
}