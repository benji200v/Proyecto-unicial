<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Equipo extends Model
{
    protected $fillable = [
        'usuario_id',
        'marca',
        'modelo',
        'procesador',
        'ram',
        'numero_de_serie',
        'disco_duro',
        'sistema_operativo',
        'ip',
        'categoria',
        'estado',
        'descripcion_baja',
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
        return $query->where('estado', 'activo');
    }

    /**
     * Scope para filtrar por marca.
     */
    public function scopePorMarca($query, $marca)
    {
        return $query->where('marca', $marca);
    }
}
