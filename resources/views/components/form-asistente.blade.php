<form id="form_asistente" action="{{ $action }}" method="POST" class="form_m">
    @csrf
    @if($method !== 'POST')
        @method($method)
    @endif

    <div class="pad_field">
        <p>Nombre</p>
        <input type="text" name="nombre" value="{{ old('nombre', $asistente->nombre ?? '') }}" class="field_m" required>
    </div>

    <div class="pad_field">
        <p>CUIT</p>
        <input type="text" name="cuit" value="{{ old('cuit', $asistente->cuit ?? '') }}" class="field_m" required>
    </div>

    <div class="pad_field">
        <p>Condición Fiscal</p>
        <select name="condicion_fiscal" class="field_m" required>
            <option value="1" {{ old('condicion_fiscal', $asistente->condicion_fiscal ?? '') == 1 ? 'selected' : '' }}>
                Responsable Inscripto
            </option>
            <option value="2" {{ old('condicion_fiscal', $asistente->condicion_fiscal ?? '') == 2 ? 'selected' : '' }}>
                Responsable Exento
            </option>
            <option value="3" {{ old('condicion_fiscal', $asistente->condicion_fiscal ?? '') == 3 ? 'selected' : '' }}>
                Responsable Monotributo
            </option>
        </select>
    </div>

    
    <div class="pad_field">
        <p>Email</p>
        <input type="text" name="email" value="{{ old('email', $asistente->email ?? '') }}" class="field_m" required>
    </div>

    <div class="pad_field">
        <p>Teléfono</p>
        <input type="text" name="telefono" value="{{ old('telefono', $asistente->telefono ?? '') }}" class="field_m">
    </div>

    <div class="pad_field">
        <p>Dirección</p>
        <input type="text" name="direccion" value="{{ old('direccion', $asistente->direccion ?? '') }}" required class="field_m">
    </div>

    <div class="pad_field">
        <p>Localidad</p>
        <input type="text" name="localidad" value="{{ old('localidad', $asistente->localidad ?? '') }}" required class="field_m">
    </div>

    <div class="pad_field">
        <p>
            <input type="checkbox" name="activo" {{ old('activo', $asistente->activo ?? false) ? 'checked' : '' }}>
            <span>Activo</span>
        </p>
    </div>

    <div class="flex justify-between">
        <a href="{{ route('asistentes.index') }}" class="btn_green">← Cancelar</a>
        <button type="submit" class="btn_green">{{ $submit }}</button>
    </div>
</form>