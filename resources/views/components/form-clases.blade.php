<form id="form_clases" action="{{ $action }}" method="POST" class="form_m">
    @csrf
    @if($method !== 'POST')
        @method($method)
    @endif

    <div class="pad_field">
        <p>Nombre</p>
        <input type="text" name="nombre" value="{{ old('nombre', $clases->nombre ?? '') }}" class="field_m" required>
    </div>

    <div class="pad_field">
        <p>Tipo de costo</p>
        <select name="tipo_costo" class="field_m" required>
            <option value="1" {{ old('tipo_costo', $clases->tipo_costo ?? '') == 1 ? 'selected' : '' }}>
                Por Clase
            </option>
            <option value="2" {{ old('tipo_costo', $clases->tipo_costo ?? '') == 2 ? 'selected' : '' }}>
                Semanal
            </option>
            <option value="3" {{ old('tipo_costo', $clases->tipo_costo ?? '') == 3 ? 'selected' : '' }}>
                Mensual
            </option>
        </select>
    </div>

    <div class="pad_field">
    <p>Costo</p>
    <input type="number"
           name="costo"
           value="{{ old('costo', $clases->costo ?? '') }}"
           class="field_m"
           step="0.01"
           min="0"
           required>
</div>


    <div class="pad_field">
        <p>
            <input type="checkbox" name="activo" {{ old('activo', $clases->activo ?? false) ? 'checked' : '' }}>
            <span>Activo</span>
        </p>
    </div>

    <div class="flex justify-between">
        <a href="{{ route('clases.index') }}" class="btn_green">← Cancelar</a>
        <button type="submit" class="btn_green">{{ $submit }}</button>
    </div>