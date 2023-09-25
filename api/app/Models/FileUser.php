<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FileUser extends Model
{
    use HasFactory;

    // Opcional: Especificar el nombre de la tabla (no es necesario si sigue las convenciones de Laravel)
    protected $table = 'file_user';

    // Opcional: Especificar la clave primaria (no es necesario si sigue las convenciones)
    protected $primaryKey = 'id';

    /**
     * Atributos que se pueden asignar masivamente
     * @var array<string>
     */
    protected $fillable = [
        'downloaded', //verifica si el archivo fue descargado
        'enabled', //verifica si ya tiene acceso al archivo para descargar
        'file_id', //id del archivo
        'user_id', //id del usuario que descarga
    ];
}
