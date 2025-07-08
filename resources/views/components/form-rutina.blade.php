<form id="form_rutina" action="{{ $action }}" method="POST" class="form_m">
    @csrf
    @if($method !== 'POST')
        @method($method)
    @endif

    <div class="pad_field">
        <p>Nombre</p>
        <input type="text" name="nombre" value="{{ old('nombre', $rutina->nombre ?? '') }}" class="field_m" required>
    </div>


    <div class="flex justify-between">
        <a href="{{ route('rutinas.index') }}" class="btn_green">← Cancelar</a>
        <button type="submit" class="btn_green">{{ $submit }}</button>
    </div>
</form>