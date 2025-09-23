<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Equipo;
use App\Models\Baja;
use Carbon\Carbon;

class BajaSeeder extends Seeder
{
    public function run(): void
    {
        // Tomamos 2 equipos (si hay menos, tomará lo que exista)
        $equipos = Equipo::take(2)->get();

        foreach ($equipos as $equipo) {
            // Marcar estado en la tabla equipos
            $equipo->estado = 'baja';
            $equipo->save();

            // Crear registro en la tabla bajas
            Baja::create([
                'equipo_id' => $equipo->id,
                'motivo' => 'Retiro simulado por obsolescencia (seeder)',
                'fecha_baja' => Carbon::now(),
            ]);
        }
    }
}
