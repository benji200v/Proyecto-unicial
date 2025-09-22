<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use App\Models\Departamento;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UsuarioController extends Controller
{
    /**
     * Mostrar listado paginado de usuarios.
     */
    public function index(Request $request)
    {
        $usuarios = Usuario::with('departamento','equipo')
                    ->orderBy('nombre')
                    ->paginate(15);

        return view('usuarios.index', compact('usuarios'));
    }

    /**
     * Mostrar formulario para crear un usuario.
     */
    public function create()
    {
        $departamentos = Departamento::orderBy('nombre')->get();
        return view('usuarios.create', compact('departamentos'));
    }

    /**
     * Almacenar un nuevo usuario.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:150',
            'apellido' => 'required|string|max:150',
            'correo' => 'required|email|max:150|unique:usuarios,correo',
            'departamento_id' => 'required|exists:departamentos,id',
        ]);

        Usuario::create($validated);

        return redirect()->route('usuarios.index')
                         ->with('success', 'Usuario creado correctamente.');
    }

    /**
     * Mostrar un usuario (detalles).
     */
    public function show(Usuario $usuario)
    {
        $usuario->load('departamento','equipo');
        return view('usuarios.show', compact('usuario'));
    }

    /**
     * Mostrar formulario de edición.
     */
    public function edit(Usuario $usuario)
    {
        $departamentos = Departamento::orderBy('nombre')->get();
        return view('usuarios.edit', compact('usuario','departamentos'));
    }

    /**
     * Actualizar usuario.
     */
    public function update(Request $request, Usuario $usuario)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:150',
            'apellido' => 'required|string|max:150',
            // permitir el mismo correo del usuario actual
            'correo' => [
                'required','email','max:150',
                Rule::unique('usuarios','correo')->ignore($usuario->id),
            ],
            'departamento_id' => 'required|exists:departamentos,id',
        ]);

        $usuario->update($validated);

        return redirect()->route('usuarios.index')
                         ->with('success', 'Usuario actualizado correctamente.');
    }

    /**
     * Eliminar usuario.
     */
    public function destroy(Usuario $usuario)
    {
        // Nota: según tus migraciones, al eliminar usuario sus equipos se eliminan (cascade).
        $usuario->delete();

        return redirect()->route('usuarios.index')
                         ->with('success', 'Usuario eliminado correctamente.');
    }
}
