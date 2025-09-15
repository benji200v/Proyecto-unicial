<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Departamento extends Model
{
    protected $fillable = ['nombre'];

    /**
     * Usuarios que pertenecen al departamento.
     */
    public function usuarios(): HasMany
    {
        return $this->hasMany(Usuario::class);
    }

    /**
     * Equipos del departamento (a través de los usuarios).
     * Útil para consultar rápidamente equipos por área.
     */
    public function equipos(): HasManyThrough
    {
        // (Equipo, Usuario, claveForaneaEnUsuarios, claveForaneaEnEquipos, localKeyDept, localKeyUsuario)
        return $this->hasManyThrough(Equipo::class, Usuario::class, 'departamento_id', 'usuario_id', 'id', 'id');
    }
}
