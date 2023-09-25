<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    // Opcional: Especificar el nombre de la tabla (no es necesario si sigue las convenciones de Laravel)
    protected $table = 'courses';

    // Opcional: Especificar la clave primaria (no es necesario si sigue las convenciones)
    protected $primaryKey = 'id';

    /**
     * Atributos que se pueden asignar masivamente
     * @var array<string>
     */
    protected $fillable = [
        'title', //titulo del curso
        'start_date', //fecha de inicio del curso
        'coupons', //cupones disponibles, si no es ingresado no hay limite
        'image', //url de la imagen del curso
        'description', //una breve descripcion del curso
        'price', //precio del curso en el momento de inscripcion
    ];

    /**
     * Obtiene todos los usuarios que realizan el curso
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users()
    {
        return $this->belongsToMany(User::class, 'course_user')
            ->withPivot(['inscription_date', 'payment_amount', 'completion_percentage', 'average_grade', 'certificate'])
            ->withTimestamps();
    }

    /**
     * Obtiene todos los modulos que tienen este curso
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function modules()
    {
        return $this->hasMany(Module::class);
    }
}
