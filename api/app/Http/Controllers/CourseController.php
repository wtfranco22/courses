<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;

class CourseController extends Controller
{
    /**
     * Display a listing of the courses.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $courses = Course::all();
        return response()->json(['data' => $courses], 200);
    }

    /**
     * Store a newly created course in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:100',
            'description' => 'required|string',
            'start_date' => 'required|date|after:tomorrow',
            'coupons' => 'integer',
            'image' => 'required|string',
            'price' => 'required|double',
        ]);
        $course = Course::create($validatedData);
        return response()->json(['message' => 'Curso creado con éxito', 'data' => $course], 201);
    }

    /**
     * Display the specified course.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $course = Course::with('modules','users')->find($id);
        if (!$course) {
            return response()->json(['message' => 'Curso no encontrado'], 404);
        }
        return response()->json(['data' => $course], 200);
    }

    /**
     * Update the specified course in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        $course = Course::find($id);
        if (!$course) {
            return response()->json(['message' => 'Curso no encontrado'], 404);
        }
        $validatedData = $request->validate([
            'title' => 'string|max:100|unique',
            'description' => 'string',
            'start_date' => 'date|after:tomorrow',
            'coupons' => 'integer',
            'image' => 'string',
            'price' => 'double',
            'enabled'=> 'boolean'
        ]);
        $course->update($validatedData);
        return response()->json(['message' => 'Curso actualizado con éxito', 'data' => $course], 200);
    }

    /**
     * Remove the specified course from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $course = Course::find($id);
        if (!$course) {
            return response()->json(['message' => 'Curso no encontrado'], 404);
        }
        $course->delete();
        return response()->json(null, 204);
    }
}
