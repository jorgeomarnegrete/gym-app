
@props(['action', 'method', 'submit', 'clasesocio', 'socios', 'asistentes', 'clases'])

<<form id="form_clasesocio" action="{{ $action }}" method="POST" class="form_m">
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
                    @selected(old('socio_id', $clasesocio->socio_id ?? '') == $socio->id)>
                    {{ $socio->nombre }}
                </option>
            @endforeach
        </select>
    </div>

        <div class="pad_field">
        <p>Clase</p>
        <select name="clase_id" class="field_m" required>
            <option value="" disabled selected>Seleccionar clase...</option>
            @foreach($clases as $clase)
                <option value="{{ $clase->id }}" 
                    @selected(old('clase_id', $clasesocio->clase_id ?? '') == $clase->id)>
                    {{ $clase->nombre }}
                </option>
            @endforeach
        </select>
    </div>


    <div class="pad_field">
        <p>Asistente</p>
        <select name="asistente_id" class="field_m" required>
            <option value="" disabled selected>Seleccionar Asistente...</option>
            @foreach($asistentes as $asistente)
                <option value="{{ $asistente->id }}" 
                    @selected(old('asistente_id', $clasesocio->asistente_id ?? '') == $asistente->id)>
                    {{ $asistente->nombre }}
                </option>
            @endforeach
        </select>
    </div>


    <div class="pad_field">
        <p>Fecha</p>
        <input type="date" name="fecha" value="{{ old('fecha', $clasesocio->fecha ?? '') }}" class="field_m" required>
    </div>

    <div class="pad_field">
        <label>
            <input type="hidden" name="asistio" value="0">
            <input type="checkbox" name="asistio" value="1"
                @checked(old('asistio', $clasesocio->asistio ?? false))>
            Asistió
        </label>
    </div>


    <div class="flex justify-between">
        <a href="{{ route('clasesocios.index') }}" class="btn_green">← Cancelar</a>
        <button type="submit" class="btn_green">{{ $submit }}</button>
    </div>
</form>