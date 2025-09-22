<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Equipo;

class EquiposSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Equipo::create([
            'nombre' => 'Equipo Alpha',
            'descripcion' => 'Primer equipo creado con seeder',
        ]);

        Equipo::create([
            'nombre' => 'Equipo Beta',
            'descripcion' => 'Segundo equipo de prueba',
        ]);
    }
}
