<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Baja extends Model
{
    protected $table = 'bajas';

    protected $fillable = [
        'equipo_id',
        'motivo',
        'fecha_baja',
    ];

    protected $dates = ['fecha_baja'];

    /**
     * Equipo relacionado a esta baja.
     */
    public function equipo(): BelongsTo
    {
        return $this->belongsTo(Equipo::class);
    }
}
