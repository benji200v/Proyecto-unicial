<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Departamento extends Model
{
    protected $fillable = [
        'nombre',
        'ubicacion',
    ];

    /**
     * Usuarios que pertenecen al departamento.
     */
    public function usuarios(): HasMany
    {
        return $this->hasMany(Usuario::class);
    }

    /**
     * Equipos del departamento (a través de los usuarios).
     */
    public function equipos(): HasManyThrough
    {
        return $this->hasManyThrough(
            Equipo::class,
            Usuario::class,
            'departamento_id', // FK en usuarios
            'usuario_id',      // FK en equipos
            'id',              // PK en departamentos
            'id'               // PK en usuarios
        );
    }
}
