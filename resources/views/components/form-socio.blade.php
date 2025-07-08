<form id="form_socio" action="{{ $action }}" method="POST" class="form_m">
    @csrf
    @if($method !== 'POST')
        @method($method)
    @endif

    <div class="pad_field">
        <p>Nombre</p>
        <input type="text" name="nombre" value="{{ old('nombre', $socio->nombre ?? '') }}" class="field_m" required>
    </div>

    <div class="pad_field">
        <p>DNI</p>
        <input type="text" name="dni" value="{{ old('dni', $socio->dni ?? '') }}" class="field_m" required>
    </div>

    <div class="pad_field">
        <p>Fecha de nacimiento</p>
        <input type="text" id="fecha_nac" name="fecha_nac"
            value="{{ old('fecha_nac', isset($socio->fecha_nac) ? \Carbon\Carbon::parse($socio->fecha_nac)->format('d/m/Y') : '') }}"
            class="field_m" required>
        <div id="error_fecha_nac" class="text-sm text-red-600 mt-1"></div>
    </div>

    <div class="pad_field">
        <p>Fecha de inscripción</p>
        <input type="text" id="fecha_inscripcion" name="fecha_inscripcion"
            value="{{ old('fecha_inscripcion', isset($socio->fecha_inscripcion) ? \Carbon\Carbon::parse($socio->fecha_inscripcion)->format('d/m/Y') : '') }}"
            class="field_m" required>
        <div id="error_fecha_inscripcion" class="text-sm text-red-600 mt-1"></div>
    </div>

    <div class="pad_field">
        <p>Teléfono</p>
        <input type="text" name="telefono" value="{{ old('telefono', $socio->telefono ?? '') }}" class="field_m">
    </div>

    <div class="pad_field">
        <p>Dirección</p>
        <input type="text" name="direccion" value="{{ old('direccion', $socio->direccion ?? '') }}" required class="field_m">
    </div>

    <div class="pad_field">
        <p>Localidad</p>
        <input type="text" name="localidad" value="{{ old('localidad', $socio->localidad ?? '') }}" required class="field_m">
    </div>

    <div class="pad_field">
        <p>Seguro Médico</p>
        <input type="text" name="seguro_medico" value="{{ old('seguro_medico', $socio->seguro_medico ?? '') }}" required class="field_m">
    </div>

    <div class="pad_field">
        <p>Teléfono de emergencia</p>
        <input type="text" name="tel_emergencia" value="{{ old('tel_emergencia', $socio->tel_emergencia ?? '') }}" required class="field_m">
    </div>

    <div class="pad_field">
        <p>
            <input type="checkbox" name="activo" {{ old('activo', $socio->activo ?? false) ? 'checked' : '' }}>
            <span>Activo</span>
        </p>
    </div>

    <div class="flex justify-between">
        <a href="{{ route('socios.index') }}" class="btn_green">← Cancelar</a>
        <button type="submit" class="btn_green">{{ $submit }}</button>
    </div>
</form>