<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $auditors = User::role('Auditor')->get();
        return response()->json(['message' => 'success', 'auditors' => $auditors]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'password_confirmation' => ['required', 'string', 'min:8'],
        ],[],[
            'name' => 'Nombre',
            'email' => 'Correo electrónico',
            'password' => 'Contraseña',
            'password_confirmation' => 'Confirmación de Contraseña',
        ]);

        User::create($request->all())->assignRole('Auditor');
        return response()->json(['message' => 'success']);
    }

    public function show(User $user)
    {
        return response()->json(['message' => 'success', 'auditor' => $user]);
    }

    public function update(Request $request, User $user)
    {
        $user->update($request->all());
        return response()->json(['message' => 'success']);
    }

    public function destroy(User $user)
    {
        $user->delete();
        return response()->json(['message' => 'success']);
    }
}
