<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Equipo extends Model
{
    protected $fillable = [
        'nombre',
        'marca',
        'modelo',
        'numero_serie',
        'descripcion',
        'activo',       // boolean: true = activo, false = baja
        'usuario_id',
    ];

    protected $casts = [
        'activo' => 'boolean',
    ];

    /**
     * Usuario al que está asignado el equipo.
     */
    public function usuario(): BelongsTo
    {
        return $this->belongsTo(Usuario::class);
    }

    /**
     * Registros de bajas asociados a este equipo.
     */
    public function bajas(): HasMany
    {
        return $this->hasMany(Baja::class, 'equipo_id');
    }

    /**
     * Scope para equipos activos.
     */
    public function scopeActivos($query)
    {
        return $query->where('activo', true);
    }

    /**
     * Scope para filtrar por marca (ejemplo de ayuda).
     */
    public function scopePorMarca($query, $marca)
    {
        return $query->where('marca', $marca);
    }
}
