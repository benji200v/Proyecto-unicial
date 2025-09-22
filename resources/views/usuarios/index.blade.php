@extends('layouts.app')

@section('content')
<h1>Usuarios</h1>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<a href="{{ route('usuarios.create') }}" class="btn btn-primary">Nuevo usuario</a>

<table class="table">
    <thead>
        <tr>
            <th>Nombre</th>
            <th>Correo</th>
            <th>Departamento</th>
            <th>Equipo (serie)</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
    @foreach($usuarios as $u)
        <tr>
            <td>{{ $u->nombre }} {{ $u->apellido }}</td>
            <td>{{ $u->correo }}</td>
            <td>{{ $u->departamento->nombre ?? '-' }}</td>
            <td>{{ $u->equipo->numero_serie ?? 'Sin equipo' }}</td>
            <td>
                <a href="{{ route('usuarios.show', $u) }}" class="btn btn-sm btn-info">Ver</a>
                <a href="{{ route('usuarios.edit', $u) }}" class="btn btn-sm btn-warning">Editar</a>

                <form action="{{ route('usuarios.destroy', $u) }}" method="POST" style="display:inline-block" onsubmit="return confirm('Eliminar usuario?');">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-sm btn-danger">Eliminar</button>
                </form>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>

{{ $usuarios->links() }}

@endsection
