<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;

class UsuarioController extends Controller
{
    public function index()
    {
        // Listar todos los usuarios con su departamento y equipo
        $usuarios = Usuario::with(['departamento', 'equipo'])->get();
        return response()->json($usuarios);
    }

    public function store(Request $request)
    {
        // Validar y crear un nuevo usuario
        $data = $request->validate([
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'correo' => 'required|email|unique:usuarios,correo',
            'departamento_id' => 'required|exists:departamentos,id',
        ]);

        $usuario = Usuario::create($data);

        return response()->json($usuario, 201);
    }

    public function show($id)
    {
        // Mostrar un usuario con sus relaciones
        $usuario = Usuario::with(['departamento', 'equipo'])->findOrFail($id);
        return response()->json($usuario);
    }

    public function update(Request $request, $id)
    {
        $usuario = Usuario::findOrFail($id);

        $data = $request->validate([
            'nombre' => 'sometimes|string|max:255',
            'apellido' => 'sometimes|string|max:255',
            'correo' => 'sometimes|email|unique:usuarios,correo,' . $usuario->id,
            'departamento_id' => 'sometimes|exists:departamentos,id',
        ]);

        $usuario->update($data);

        return response()->json($usuario);
    }

    public function destroy($id)
    {
        $usuario = Usuario::findOrFail($id);
        $usuario->delete();

        return response()->json(['message' => 'Usuario eliminado']);
    }
}
