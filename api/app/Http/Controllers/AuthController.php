<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * Store a newly created User in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:50',
            'last_name' => 'required|string|max:50',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
            'address' => 'string|max:100',
            'role_id' => 'integer|min:1',
        ]);
        $validatedData['password'] = Hash::make($validatedData['password']);
        $user = User::create($validatedData);
        return response()->json(['message' => 'Usuario creado con éxito', 'data' => $user], 201);
    }

    /**
     * Ingreso de un usuario registrado
     * 
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        if (!Auth::attempt($request->only('email', 'password'))) {
            return response()->json(['message' => 'Credenciales incorrectas'], 422);
        }
        $user = User::where('email', $request['email'])->firstOrFail();
        $token = $user->createToken('auth_token')->plainTextToken;
        return response()->json(['accessToken' => $token, 'token_type' => 'Bearer', 'data' => $user], 200);
    }

    /**
     * Obtiene los valores del usuario logueado
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function user()
    {
        return response()->json(['data' => auth()->user()], 200);
    }

    /**
     * Eliminar los tokens para cerrar sesiones del usuario
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth()->user()->tokens()->delete();
        return response()->json(['message' => 'Sesion cerrada con exito!'], 200);
    }

    /**
     * Actualizar los datos del usuario
     * 
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateProfile(Request $request)
    {
        $user = User::find(auth()->user()->id);
        $validatedData = $request->validate([
            'name' => 'string|max:50',
            'last_name' => 'string|max:50',
            'password' => 'nullable|string|min:6',
            'current_password' => 'nullable|string|min:6',
            'address' => 'string|max:100',
            'enabled' => 'boolean:false',
        ]);
        if (isset($validatedData['password'])) {
            $currentPassword = $request->input('current_password');
            if (!Hash::check($currentPassword, $user->password)) {
                return response()->json(['message' => 'La contraseña actual no es válida'], 400);
            }
            $validatedData['password'] = Hash::make($validatedData['password']);
        }
        $user->update($validatedData);
        return response()->json(['message' => 'Perfil actualizado con éxito', 'data' => $user], 200);
    }
}
