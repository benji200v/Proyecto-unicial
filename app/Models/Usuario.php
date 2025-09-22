<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Usuario extends Model
{
    protected $fillable = [
        'nombre',
        'apellido',
        'correo',
        'departamento_id',
    ];

    /**
     * Departamento al que pertenece el usuario.
     */
    public function departamento(): BelongsTo
    {
        return $this->belongsTo(Departamento::class);
    }

    /**
     * Equipo asignado al usuario (1:1).
     */
    public function equipo(): HasOne
    {
        return $this->hasOne(Equipo::class);
    }
}
