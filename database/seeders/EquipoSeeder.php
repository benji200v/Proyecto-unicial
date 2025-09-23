<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Equipo;
use App\Models\Usuario;

class EquipoSeeder extends Seeder
{
    public function run(): void
    {
        $brands = ['Lenovo','HP','Dell','Acer','Asus'];
        $models = ['MT-M7483-AH7','EliteBook 840','OptiPlex 7090','Aspire 5','ZenBook 14'];
        $procesadores = ['Core2 Duo E8400','Intel Core i5','Intel Core i7','AMD Ryzen 5','Intel Core i3'];
        $rams = ['2GB','4GB','8GB','16GB'];
        $discos = ['160GB','256GB SSD','512GB SSD','1TB HDD'];
        $sos = ['Windows 7','Windows 10','Windows 11','Linux'];
        $categoria = ['personal','escritorio'];

        $usuarios = Usuario::all();
        $i = 1;

        foreach ($usuarios as $user) {
            Equipo::create([
                'usuario_id' => $user->id,
                'marca' => $brands[$i % count($brands)],
                'modelo' => $models[$i % count($models)],
                'procesador' => $procesadores[$i % count($procesadores)],
                'ram' => $rams[$i % count($rams)],
                'numero_de_serie' => 'SN-' . strtoupper(uniqid()). '-' . $i,
                'disco_duro' => $discos[$i % count($discos)],
                'sistema_operativo' => $sos[$i % count($sos)],
                'ip' => '192.168.100.' . (100 + $i),
                'categoria' => $categoria[$i % 2],
                'estado' => 'activo',
                'descripcion_baja' => null,
            ]);
            $i++;
        }

        // (Opcional) crear 2 equipos sin asignar si tu FK permite null.
        // Si tu migration NO permite usuario_id null, omite esto.
        // Equipo::create([... 'usuario_id' => null, ...]);
    }
}
