@csrf

<div class="mb-3">
    <label>Nombre</label>
    <input type="text" name="nombre" value="{{ old('nombre', $usuario->nombre ?? '') }}" class="form-control" required>
</div>

<div class="mb-3">
    <label>Apellido</label>
    <input type="text" name="apellido" value="{{ old('apellido', $usuario->apellido ?? '') }}" class="form-control" required>
</div>

<div class="mb-3">
    <label>Correo</label>
    <input type="email" name="correo" value="{{ old('correo', $usuario->correo ?? '') }}" class="form-control" required>
</div>

<div class="mb-3">
    <label>Departamento</label>
    <select name="departamento_id" class="form-control" required>
        <option value="">-- seleccionar --</option>
        @foreach($departamentos as $d)
            <option value="{{ $d->id }}" {{ (old('departamento_id', $usuario->departamento_id ?? '') == $d->id) ? 'selected' : '' }}>
                {{ $d->nombre }}
            </option>
        @endforeach
    </select>
</div>
