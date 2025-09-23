<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Departamento;

class DepartamentoSeeder extends Seeder
{
    public function run(): void
    {
        $nombres = ['Sistemas','Recursos Humanos','Administración','Finanzas','Archivo'];

        foreach ($nombres as $nombre) {
            Departamento::create(['nombre' => $nombre]);
        }
    }
}
