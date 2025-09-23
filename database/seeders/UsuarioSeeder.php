<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Usuario;
use App\Models\Departamento;

class UsuarioSeeder extends Seeder
{
    public function run(): void
    {
        $users = [
            ['nombre'=>'Juan','apellido'=>'Pérez','correo'=>'juan.perez@ejemplo.local','departamento'=>'Sistemas'],
            ['nombre'=>'Ana','apellido'=>'Gómez','correo'=>'ana.gomez@ejemplo.local','departamento'=>'Sistemas'],
            ['nombre'=>'María','apellido'=>'López','correo'=>'maria.lopez@ejemplo.local','departamento'=>'Recursos Humanos'],
            ['nombre'=>'Carlos','apellido'=>'Sánchez','correo'=>'carlos.sanchez@ejemplo.local','departamento'=>'Recursos Humanos'],
            ['nombre'=>'Luis','apellido'=>'Ramírez','correo'=>'luis.ramirez@ejemplo.local','departamento'=>'Administración'],
            ['nombre'=>'Sofía','apellido'=>'Torres','correo'=>'sofia.torres@ejemplo.local','departamento'=>'Administración'],
            ['nombre'=>'Miguel','apellido'=>'Ortega','correo'=>'miguel.ortega@ejemplo.local','departamento'=>'Finanzas'],
            ['nombre'=>'Elena','apellido'=>'Morales','correo'=>'elena.morales@ejemplo.local','departamento'=>'Finanzas'],
            ['nombre'=>'Pedro','apellido'=>'Vega','correo'=>'pedro.vega@ejemplo.local','departamento'=>'Archivo'],
            ['nombre'=>'Laura','apellido'=>'Ríos','correo'=>'laura.rios@ejemplo.local','departamento'=>'Archivo'],
        ];

        foreach ($users as $u) {
            $dept = Departamento::where('nombre', $u['departamento'])->first();
            if ($dept) {
                Usuario::create([
                    'nombre' => $u['nombre'],
                    'apellido' => $u['apellido'],
                    'correo' => $u['correo'],
                    'departamento_id' => $dept->id,
                ]);
            }
        }
    }
}
