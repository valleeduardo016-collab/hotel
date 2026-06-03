@extends('layouts.app')

@section('content')
<div style="max-w: 80rem; margin-left: auto; margin-right: auto; padding-top: 2.5rem; padding-bottom: 2.5rem; padding-left: 1.5rem; padding-right: 1.5rem;">

    <div style="display: flex; justify-content: space-between; align-items: flex-end; border-bottom: 1px solid #e4e4e7; padding-bottom: 1rem; margin-bottom: 2rem;">
        <div>
            <h1 style="font-size: 1.5rem; font-weight: 700; color: #18181b; text-transform: uppercase; letter-spacing: 0.05em; margin: 0;">Gestión de Personal</h1>
            <p style="font-size: 0.75rem; color: #71717a; margin-top: 0.25rem; margin-bottom: 0;">Control y asignación de rangos de acceso al sistema.</p>
        </div>
        <a href="{{ route('superadmin.users.create') }}" 
           style="background-color: #111111 !important; color: #ffffff !important; font-size: 0.75rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.05em; padding: 0.625rem 1.25rem; text-decoration: none; transition: all 0.2s;">
            + Nuevo Usuario
        </a>
    </div>

    <div style="background-color: #ffffff; border: 1px solid #111111; overflow: hidden; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);">
        <div style="overflow-x: auto;">
            <table style="min-w-full: 100%; width: 100%; border-collapse: collapse; text-align: left;">
                <thead style="background-color: #111111 !important;">
                    <tr style="font-size: 11px; font-weight: 700; color: #ffffff !important; text-transform: uppercase; letter-spacing: 0.1em;">
                        <th style="padding: 1rem 1.5rem;">Nombre Completo</th>
                        <th style="padding: 1rem 1.5rem;">Correo Electrónico</th>
                        <th style="padding: 1rem 1.5rem;">Rol de Sistema</th>
                        <th style="padding: 1rem 1.5rem; text-align: right; padding-right: 2rem;">Acciones</th>
                    </tr>
                </thead>
                <tbody style="background-color: #ffffff;">
                    @foreach($users as $user)
                    <tr style="border-bottom: 1px solid #e4e4e7; transition: background-color 0.2s;">
                        <td style="padding: 1rem 1.5rem; font-size: 0.875rem; font-weight: 700; color: #18181b;">
                            {{ $user->name }}
                        </td>
                        
                        <td style="padding: 1rem 1.5rem; font-size: 0.875rem; color: #4b5563;">
                            {{ $user->email }}
                        </td>
                        
                        <td style="padding: 1rem 1.5rem;">
                            @if($user->role == 'super_admin')
                                <span style="background-color: #000000 !important; color: #ffffff !important; font-weight: 900; text-transform: uppercase; padding: 0.25rem 0.625rem; font-size: 10px; letter-spacing: 0.1em;">Super Admin</span>
                            @elseif($user->role == 'admin_hotel')
                                <span style="background-color: #27272a !important; color: #ffffff !important; font-weight: 700; text-transform: uppercase; padding: 0.25rem 0.625rem; font-size: 10px; letter-spacing: 0.1em;">Admin Hotel</span>
                            @else
                                <span style="background-color: #f4f4f5; color: #18181b; border: 1px solid #d4d4d8; font-weight: 700; text-transform: uppercase; padding: 0.25rem 0.625rem; font-size: 10px; letter-spacing: 0.1em;">{{ $user->role }}</span>
                            @endif
                        </td>
                        
                        <td style="padding: 1rem 1.5rem; text-align: right; padding-right: 2rem; font-size: 0.875rem;">
                            <div style="display: inline-flex; align-items: center; gap: 1rem;">
                                <a href="{{ route('superadmin.users.edit', $user) }}" 
                                   style="color: #18181b; font-weight: 800; font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.05em; text-decoration: none;">
                                    Editar
                                </a>

                                <span style="color: #d4d4d8;">/</span>

                                <form method="POST" action="{{ route('superadmin.users.destroy', $user) }}" 
                                      style="margin: 0; padding: 0; display: inline;"
                                      onsubmit="return confirm('¿Confirmas la baja definitiva de este usuario?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            style="color: #9ca3af; background: transparent; border: none; cursor: pointer; padding: 0; margin: 0; font-weight: 700; font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.05em; transition: color 0.2s;"
                                            onmouseover="this.style.color='#dc2626'" 
                                            onmouseout="this.style.color='#9ca3af'">
                                        Eliminar
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection