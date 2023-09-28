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

    /**
     * obtenemos todos los cursos que corresponde del usuario
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function myCourses()
    {
        $courses = User::with('courses')->find(auth()->user()->id);
        if (!$courses) {
            return response()->json(['message' => 'Cursos no encontrados'], 404);
        }
        return response()->json(['data' => $courses], 200);
    }

    /**
     * obtenemos todos los modulos que corresponde del usuario
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function courseShow($id)
    {
        $user = User::with([
            'modules' => function ($query) use ($id) {
                $query->where('course_id', $id);
            },
            'courses' => function ($query) use ($id) {
                $query->where('courses.id', $id);
            }
        ])->find(auth()->user()->id);
        if (!$user) {
            return response()->json(['message' => 'Usuario no encontrado'], 404);
        }
        return response()->json(['data' => $user], 200);
    }

    /**
     * obtenemos todos los archivos que corresponde del modulo
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function moduleShow($id)
    {
        $user = User::with([
            //obtenemos el que quiere ver el usuario
            'modules' => function ($query) use ($id) {
                $query->where('modules.id', $id);
            },
            'modules.files:file_module.order', //con los archivos de ese modulo
        ])->find(auth()->user()->id);

        $module = $user->modules->first(); // lo convertimos a un objeto
        $filesIds = $module->files->map(function ($file) {
            //conseguimos un arreglo de id's de los archivos
            return $file->id;
        });

        $user = User::with([
            'files' => function ($query) use ($filesIds) {
                $query->whereIn('files.id', $filesIds);
            }
            //whereIn recibe un arreglo con valores
        ])->find(auth()->user()->id);

        $module->setRelation('files', null);

        $data = [
            "module" => $module,
            "files" => $user->files
        ];

        if (!$user) {
            return response()->json(['message' => 'Usuario no encontrado'], 404);
        }
        return response()->json(['data' => $data], 200);
    }

    /**
     * inscripcion a un nuevo curso
     * 
     * @param \Illuminate\Http\Request
     * @return \Illuminate\Http\JsonResponse
     */
    public function inscription(Request $request)
    {
        $validatedData = $request->validate([
            'course_id' => 'integer|min:1',
            'sale' => 'boolean'
        ]);
        $result = inscriptionCourse($validatedData);
        if ($result === true) {
            return response()->json(['message' => 'La inscripcion fue realizada con exito'], 200);
        }
        return response()->json(['message' => $result], 403);
    }
}
