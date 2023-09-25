<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModuleUser extends Model
{
    use HasFactory;
    // Opcional: Especificar el nombre de la tabla (no es necesario si sigue las convenciones de Laravel)
    protected $table = 'module_user';

    // Opcional: Especificar la clave primaria (no es necesario si sigue las convenciones)
    protected $primaryKey = 'id';

    /**
     * Atributos que se pueden asignar masivamente
     * @var array<string>
     */
    protected $fillable = [
        'state', //estado del proceso del usuario sobre el modulo
        'calification', //nota final del usuario sobre el modulo
        'description', //descripcion adicional del usuario sobre el modulo
        'enabled', //verificamos si el usuario tiene acceso al modulo
        'module_id', //id del modulo
        'user_id' //id del usuario
    ];
}
