<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\File;

class FileController extends Controller
{
    /**
     * Display a listing of the Files.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $files = File::all();
        return response()->json(['data' => $files], 200);
    }

    /**
     * Store a newly created File in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:50',
            'description' => 'required|string',
            'content' => 'required|string',
        ]);
        $file = File::create($validatedData);
        return response()->json(['message' => 'Archivo creado con éxito', 'data' => $file], 201);
    }

    /**
     * Display the specified File.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $file = File::find($id);
        if (!$file) {
            return response()->json(['message' => 'Archivo no encontrado'], 404);
        }
        return response()->json(['data' => $file], 200);
    }

    /**
     * Update the specified File in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        $file = File::find($id);
        if (!$file) {
            return response()->json(['message' => 'Archivo no encontrado'], 404);
        }
        $validatedData = $request->validate([
            'name' => 'string|max:50',
            'description' => 'string',
            'content' => 'string',
        ]);
        $file->update($validatedData);
        return response()->json(['message' => 'Archivo actualizado con éxito', 'data' => $file], 200);
    }

    /**
     * Remove the specified File from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $file = File::find($id);
        if (!$file) {
            return response()->json(['message' => 'Archivo no encontrado'], 404);
        }
        $file->delete();
        return response()->json(null, 204);
    }
}
