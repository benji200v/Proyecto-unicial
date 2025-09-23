<?php

namespace App\Http\Controllers;

use App\Models\Baja;
use App\Models\Equipo;
use Illuminate\Http\Request;

class BajaController extends Controller
{
    public function index()
    {
        $bajas = Baja::with('equipo.usuario')->orderByDesc('fecha_baja')->paginate(12);
        return view('bajas.index', compact('bajas'));
    }

    public function create()
    {
        // Mostrar solo equipos activos para dar de baja
        $equipos = Equipo::where('estado', 'activo')->with('usuario')->get();
        return view('bajas.create', compact('equipos'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'equipo_id' => 'required|exists:equipos,id',
            'motivo' => 'required|string|max:500',
            'fecha_baja' => 'nullable|date',
        ]);

        // Crear la baja
        $baja = Baja::create([
            'equipo_id' => $data['equipo_id'],
            'motivo' => $data['motivo'],
            'fecha_baja' => $data['fecha_baja'] ?? now(),
        ]);

        // Actualizar el equipo como dado de baja
        $equipo = Equipo::findOrFail($data['equipo_id']);
        $equipo->estado = 'baja';
        $equipo->descripcion_baja = $data['motivo'];
        $equipo->save();

        return redirect()->route('bajas.index')
                         ->with('success', 'Baja registrada y equipo marcado como dado de baja.');
    }

    public function show(Baja $baja)
    {
        $baja->load('equipo.usuario');
        return view('bajas.show', compact('baja'));
    }

    public function edit(Baja $baja)
    {
        // Si permites editar, podría mostrarse el formulario con motivo/fecha
        return view('bajas.edit', compact('baja'));
    }

    public function update(Request $request, Baja $baja)
    {
        $data = $request->validate([
            'motivo' => 'sometimes|required|string|max:500',
            'fecha_baja' => 'sometimes|required|date',
        ]);

        $baja->update($data);

        // Nota: no revertimos el estado del equipo aquí (si quieres lógica distinta la añadimos)
        return redirect()->route('bajas.index')
                         ->with('success', 'Registro de baja actualizado.');
    }

    public function destroy(Baja $baja)
    {
        // Si eliminas la baja, no revertimos automáticamente el estado del equipo
        // (Decisión: mantener histórico. Si prefieres revertir estado, lo agregamos)
        $baja->delete();

        return redirect()->route('bajas.index')
                         ->with('success', 'Registro de baja eliminado.');
    }
}
