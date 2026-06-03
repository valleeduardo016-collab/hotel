<h1>Editar Rol</h1>

<form method="POST" action="{{ route('superadmin.users.update', $user) }}">
    @csrf
    @method('PUT')

    <p>{{ $user->name }} ({{ $user->email }})</p>

    <select name="role">
        <option value="user" @selected($user->role=='user')>User</option>
        <option value="admin" @selected($user->role=='admin')>Admin</option>
        <option value="super_admin" @selected($user->role=='super_admin')>Super Admin</option>
    </select>

    <button>Actualizar</button>
</form>