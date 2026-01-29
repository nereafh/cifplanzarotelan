@if(request()->input('modo') == 'ajax')
    {{-- Si es AJAX, no hacemos nada arriba, solo el contenido --}}
@else
    @extends('layout')
    @section('contenido')
@endif

<div class="container pt-4">
    {{-- Bloque de errores --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Mensaje de éxito --}}
    @if(isset($datos['exito']) && $datos['exito'])
        <p class="alert alert-success"> {{ $datos['exito'] }} </p>
    @endif

    <form action="/libro/{{ $oper }}" method="POST">
        @csrf
        <input name="id" type="hidden" value="{{ $libro->id }}" />
        
        {{-- Título --}}
        <div class="mb-3">
            <label for="idtitulo" class="form-label @error('titulo') text-danger @enderror">Título</label>
            <input {{ $disabled }} value="{{ old('titulo', $libro->titulo) }}" type="text" name="titulo" class="form-control @error('titulo') is-invalid @enderror" id="idtitulo">
        </div>

        {{-- Autor --}}
        <div class="mb-3">
            <label for="idautor" class="form-label @error('autor') text-danger @enderror">Autor</label>
            <input {{ $disabled }} value="{{ old('autor', $libro->autor) }}" type="text" name="autor" class="form-control @error('autor') is-invalid @enderror" id="idautor">
        </div>

        {{-- Año --}}
        <div class="mb-3">
            <label for="idanho" class="form-label @error('anho') text-danger @enderror">Año publicación</label>
            <select {{ $disabled }} class="form-select @error('anho') is-invalid @enderror" id="idanho" name="anho">
                <option value=""></option>
                @for($anho = date('Y')-10; $anho <= date('Y'); $anho++)
                    <option value="{{ $anho }}" {{ old('anho', $libro->anho) == $anho ? 'selected' : '' }}>{{ $anho }}</option>
                @endfor
            </select>
        </div>

        {{-- Género --}}
        <div class="mb-3">
            <label for="idgenero" class="form-label @error('genero') text-danger @enderror">Género</label>
            <select {{ $disabled }} class="form-select @error('genero') is-invalid @enderror" id="idgenero" name="genero">
                @foreach ($cods_genero as $clave_genero => $texto_genero)    
                    <option value="{{ $clave_genero }}" {{ old('genero', $libro->genero) == $clave_genero ? 'selected' : '' }}>{{ $texto_genero }}</option>
                @endforeach
            </select>
        </div>

        {{-- Descripción --}}
        <div class="mb-3">
            <label for="iddescripcion" class="form-label @error('descripcion') text-danger @enderror">Descripción</label>
            <textarea {{ $disabled }} class="form-control @error('descripcion') is-invalid @enderror" name="descripcion" id="iddescripcion" rows="3">{{ old('descripcion', $libro->descripcion) }}</textarea>
        </div>

        @if (!$disabled)
            <button type="submit" class="btn btn-primary">Guardar Cambios</button>
        @endif

        @if ($oper == 'destroy' && (empty($datos['exito'])))
            <div class="alert alert-warning">¿Estás seguro de que quieres eliminar este libro?</div>
            <button type="submit" class="btn btn-danger">Confirmar Borrado</button>
        @endif
    </form>
    
    <hr>

    {{-- Botones de salida --}}
    @if(request()->ajax() || request()->input('modo') == 'ajax')
        <button type="button" class="btn btn-secondary mt-3" data-bs-dismiss="modal">Cerrar Ventana</button>
    @else
        <a class="btn btn-info mt-3" href="{{ route('libro.index') }}">Volver al listado</a>
    @endif
</div>

@if(request()->input('modo') == 'ajax')
@php die(); @endphp {{-- <--- ESTO ES LA CLAVE --}}
@else
@endsection
@endif