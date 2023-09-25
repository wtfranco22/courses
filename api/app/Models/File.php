<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    use HasFactory;

    // Opcional: Especificar el nombre de la tabla (no es necesario si sigue las convenciones de Laravel)
    protected $table = 'files';

    // Opcional: Especificar la clave primaria (no es necesario si sigue las convenciones)
    protected $primaryKey = 'id';

    /**
     * Atributos que se pueden asignar masivamente
     * @var array<string>
     */
    protected $fillable = [
        'name', //nombre del archivo
        'description', //breve descripcion del archivo
        'content', // es la url del archivo 
    ];

    /**
     * Obtiene todos los usuarios que pueden ver el archivo
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users()
    {
        return $this->belongsToMany(User::class, 'file_user')
            ->withPivot(['downloaded', 'enabled'])
            ->withTimestamps();
    }

    /**
     * Obtiene todos los modulos que esta presente el archivo
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function modules()
    {
        return $this->belongsToMany(Module::class, 'file_module')
            ->withPivot(['order'])
            ->withTimestamps();
    }
}
