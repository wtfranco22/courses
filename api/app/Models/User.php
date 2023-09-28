<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    // Opcional: Especificar el nombre de la tabla (no es necesario si sigue las convenciones de Laravel)
    protected $table = 'users';

    // Opcional: Especificar la clave primaria (no es necesario si sigue las convenciones)
    protected $primaryKey = 'id';

    /**
     * Atributos que se pueden asignar masivamente
     * @var array<string>
     */
    protected $fillable = [
        'name', //nombre del usuario
        'last_name', //apellido del usuario
        'address', //direccion del usuario
        'email', //correo
        'password', //contraseña
        'role_id', //rol del usuario
        'enabled', //habilitacion en el sistema de usuario
    ];

    /**
     * Los atributos que deben ocultarse en la serialización
     * @var array<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Los atributos que deben ser convertidos a tipos nativos
     * @var array<string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Obtiene el rol que tienen este usuario.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function role(){
        return $this->belongsTo(Role::class);
    }

    /**
     * Obtiene todos los cursos que realizan el usuario
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function courses()
    {
        return $this->belongsToMany(Course::class, 'course_user')
            ->withPivot(['inscription_date', 'payment_amount', 'completion_percentage', 'average_grade', 'certificate'])
            ->withTimestamps();
    }

    /**
     * Obtiene todos los modulos habilitados para ver su contenido
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function modules()
    {
        return $this->belongsToMany(Module::class, 'module_user')
            ->withPivot(['enabled', 'state', 'calification', 'description'])
            ->withTimestamps();
    }

    /**
     * Obtiene todos los archivos habilitados para descargar
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function files()
    {
        return $this->belongsToMany(File::class, 'file_user')
            ->withPivot(['downloaded', 'enabled'])
            ->withTimestamps();
    }
}
