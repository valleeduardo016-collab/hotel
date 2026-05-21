<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('superadmin.users.index', compact('users'));
    }

    public function create()
    {
        return view('superadmin.users.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
            'role'     => 'required|in:user,admin_hotel,super_admin',
        ]);

        User::create([
            'name'     => $data['name'],
            'email'    => $data['email'],
            'password' => Hash::make($data['password']), // 🔥 CLAVE
            'role'     => $data['role'],
        ]);

        return redirect()
            ->route('superadmin.users.index')
            ->with('success', 'Usuario creado correctamente');
    }

    public function destroy(User $user)
    {
        $user->delete();

        return redirect()
            ->route('superadmin.users.index')
            ->with('success', 'Usuario eliminado');
    }
}