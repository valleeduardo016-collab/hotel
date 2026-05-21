<?php

namespace App\Providers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
   //Ruta por defecto 
    
    public const HOME = '/';

   //Define las rutas del sistema
    
    public function boot(): void
    {
        parent::boot();
    }

    // Redirección automática después del login
     
    public static function redirectTo(): string
    {
        if (!Auth::check()) {
            return '/';
        }

        return match (Auth::user()->role) {
            'super_admin' => route('superadmin.dashboard'),
            'admin_hotel' => route('admin.hotel.show'),
            default => route('home'),
        };
    }
}