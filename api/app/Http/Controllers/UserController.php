<?php

namespace App\Http\Controllers;


use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Gate;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return response()->json(['data' => $users], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $user = User::find($id);
        if (!$user) {
            return response()->json(['message' => 'Usuario no encontrado'], 400);
        }
        return response()->json(['data' => $user], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        if (auth()->user()->role->name != 'Admin') {
            if (!Gate::allows('update-user', auth()->user())) {
                abort(Response::HTTP_FORBIDDEN, 'No tiene permiso para actualizar este usuario');
            }
        }
        $user = User::find($id);
        $validatedData = $request->validate([
            'enabled' => 'boolean',
        ]);
        $user->update($validatedData);
        return response()->json(['message' => 'Usuario actualizado con éxito', 'data' => $user], 200);
    }

}
