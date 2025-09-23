<?php

namespace App\Http\Controllers;

use App\Models\Equipo;
use Illuminate\Http\Request;

class EquipoController extends Controller
{
    public function index()
    {
        // Listar todos los equipos
        $equipos = Equipo::with('usuario')->get();
        return response()->json($equipos);
    }

    public function store(Request $request)
    {
        // Validar y crear un nuevo equipo
        $data = $request->validate([
            'usuario_id' => 'required|exists:usuarios,id',
            'marca' => 'required|string',
            'modelo' => 'required|string',
            'procesador' => 'required|string',
            'ram' => 'required|string',
            'numero_de_serie' => 'required|string|unique:equipos',
            'disco_duro' => 'required|string',
            'sistema_operativo' => 'required|string',
            'ip' => 'required|string|unique:equipos',
            'categoria' => 'required|in:personal,escritorio',
        ]);

        $equipo = Equipo::create($data);

        return response()->json($equipo, 201);
    }

    public function show($id)
    {
        $equipo = Equipo::with('usuario', 'bajas')->findOrFail($id);
        return response()->json($equipo);
    }

    public function update(Request $request, $id)
    {
        $equipo = Equipo::findOrFail($id);

        $data = $request->validate([
            'marca' => 'sometimes|string',
            'modelo' => 'sometimes|string',
            'estado' => 'sometimes|in:activo,baja',
        ]);

        $equipo->update($data);

        return response()->json($equipo);
    }

    public function destroy($id)
    {
        $equipo = Equipo::findOrFail($id);
        $equipo->delete();

        return response()->json(['message' => 'Equipo eliminado']);
    }
}
