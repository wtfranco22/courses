<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    // Opcional: Especificar el nombre de la tabla (no es necesario si sigue las convenciones de Laravel)
    protected $table = 'roles';

    // Opcional: Especificar la clave primaria (no es necesario si sigue las convenciones)
    protected $primaryKey = 'id';

    /**
     * Atributos que se pueden asignar masivamente
     * @var array<string>
     */
    protected $fillable = [
        'name', // nombre del rol
        'description', //breve descripcion del rol
    ];

    /**
     * Obtiene todos los usuarios que tienen este rol.
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function users()
    {
        return $this->hasMany(User::class);
    }
}
