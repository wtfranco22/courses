<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    use HasFactory;

    // Opcional: Especificar el nombre de la tabla (no es necesario si sigue las convenciones de Laravel)
    protected $table = 'modules';

    // Opcional: Especificar la clave primaria (no es necesario si sigue las convenciones)
    protected $primaryKey = 'id';

    /**
     * Atributos que se pueden asignar masivamente
     * @var array<string>
     */
    protected $fillable = [
        'name', //nombre del modulo
        'description', //breve descripcion del modulo
        'order', //es el orden de aprendizaje en el curso
        'course_id', //id del curso al que pertenece el modulo
    ];

    /**
     * Obtiene el curso al que pertenece.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function course(){
        return $this->belongsTo(Course::class);
    }

    /**
     * Obtiene todos los archivos que contiene el modulo
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function files()
    {
        return $this->belongsToMany(File::class, 'file_module')
            ->withPivot(['order'])
            ->withTimestamps();
    }

    /**
     * Obtiene todos los usuarios que tienen permiso al modulo
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users()
    {
        return $this->belongsToMany(User::class, 'module_user')
            ->withPivot(['enabled','state','calification','description'])
            ->withTimestamps();
    }
}
