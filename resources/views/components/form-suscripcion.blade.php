
@props(['action', 'method', 'submit', 'suscripcion', 'socios'])

<<form id="form_suscripcion" action="{{ $action }}" method="POST" class="form_m">
    @csrf
    @if($method !== 'POST')
        @method($method)
    @endif

    <div class="pad_field">
        <p>Socio</p>
        <select name="socio_id" class="field_m" required>
            <option value="" disabled selected>Seleccionar socio...</option>
            @foreach($socios as $socio)
                <option value="{{ $socio->id }}" 
                    @selected(old('socio_id', $suscripcion->socio_id ?? '') == $socio->id)>
                    {{ $socio->nombre }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="pad_field">
        <p>Tipo</p>
        <select name="tipo" class="field_m" required>
            <option value="" disabled selected>Seleccionar tipo...</option>
            <option value="1" @selected(old('tipo', $suscripcion->tipo ?? '') == 1)>Mensual</option>
            <option value="2" @selected(old('tipo', $suscripcion->tipo ?? '') == 2)>Diario</option>
            <option value="3" @selected(old('tipo', $suscripcion->tipo ?? '') == 3)>Por Clase</option>
            <option value="4" @selected(old('tipo', $suscripcion->tipo ?? '') == 4)>Free Pass</option>
        </select>
    </div>

    <div class="pad_field">
        <p>Forma de Pago</p>
        <select name="forma_pago" class="field_m" required>
            <option value="" disabled selected>Seleccionar forma de pago...</option>
            <option value="1" @selected(old('forma_pago', $suscripcion->forma_pago ?? '') == 1)>Efectivo</option>
            <option value="2" @selected(old('forma_pago', $suscripcion->forma_pago ?? '') == 2)>Transferencia</option>
            <option value="3" @selected(old('forma_pago', $suscripcion->forma_pago ?? '') == 3)>Débito</option>
            <option value="4" @selected(old('forma_pago', $suscripcion->forma_pago ?? '') == 4)>Crédito</option>
        </select>
    </div>

    <div class="pad_field">
        <p>Modalidad</p>
        <select name="modalidad" class="field_m">
            <option value="" disabled selected>Seleccionar...</option>
            <option value="presencial" @selected(old('modalidad', $suscripcion->modalidad ?? '') == 'presencial')>Presencial</option>
            <option value="virtual" @selected(old('modalidad', $suscripcion->modalidad ?? '') == 'virtual')>Virtual</option>
            <option value="hibrida" @selected(old('modalidad', $suscripcion->modalidad ?? '') == 'hibrida')>Híbrida</option>
        </select>
    </div>

    <div class="pad_field">
        <p>Fecha de Inicio</p>
        <input type="date" name="fecha_inicio" value="{{ old('fecha_inicio', $suscripcion->fecha_inicio ?? '') }}" class="field_m" required>
    </div>

    <div class="pad_field">
        <p>Fecha de Fin</p>
        <input type="date" name="fecha_fin" value="{{ old('fecha_fin', $suscripcion->fecha_fin ?? '') }}" class="field_m">
    </div>

    <div class="pad_field">
        <p>Monto</p>
        <input type="number" step="0.01" name="monto" value="{{ old('monto', $suscripcion->monto ?? '') }}" class="field_m" required>
    </div>

    <div class="pad_field">
        <label>
            <input type="checkbox" name="activo" value="1"
                @checked(old('activo', $suscripcion->activo ?? true))>
            Activa
        </label>
    </div>


    <div class="pad_field">
        <p>Observaciones</p>
        <textarea name="observaciones" class="field_m" rows="3">{{ old('observaciones', $suscripcion->observaciones ?? '') }}</textarea>
    </div>

    <div class="flex justify-between">
        <a href="{{ route('suscripciones.index') }}" class="btn_green">← Cancelar</a>
        <button type="submit" class="btn_green">{{ $submit }}</button>
    </div>
</form>