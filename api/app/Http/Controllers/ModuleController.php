<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Module;

class ModuleController extends Controller
{
    /**
     * Display a listing of the modules.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $modules = Module::all();
        return response()->json(['data' => $modules], 200);
    }

    /**
     * Store a newly created Module in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:50',
            'description' => 'required|string',
            'orden' => 'integer|min:0',
            'course_id' => 'required|integer|min:1',
        ]);
        $module = Module::create($validatedData);
        return response()->json(['message' => 'Modulo creado con éxito', 'data' => $module], 201);
    }

    /**
     * Display the specified Module.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $module = Module::with('files','users')->find($id);
        if (!$module) {
            return response()->json(['message' => 'Modulo no encontrado'], 404);
        }
        return response()->json(['data' => $module], 200);
    }

    /**
     * Update the specified Module in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        $module = Module::find($id);
        if (!$module) {
            return response()->json(['message' => 'Modulo no encontrado'], 404);
        }
        $validatedData = $request->validate([
            'name' => 'string|max:50',
            'description' => 'string',
            'orden' => 'integer|min:0',
        ]);
        $module->update($validatedData);
        return response()->json(['message' => 'Modulo actualizado con éxito', 'data' => $module], 200);
    }

    /**
     * Remove the specified Module from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $module = Module::find($id);
        if (!$module) {
            return response()->json(['message' => 'Modulo no encontrado'], 404);
        }
        $module->delete();
        return response()->json(null, 204);
    }
}
