@if(request()->input('modo') == 'ajax')
    {{-- Solo el contenido --}}
@else
    @extends('layout')
    @section('contenido')
@endif

<div class="container pt-4">
    {{-- Mensaje de éxito --}}
    @if(isset($datos['exito']) && $datos['exito'])
        <p class="alert alert-success"> {{ $datos['exito'] }} </p>
    @endif

    <form action="/socio/{{ $oper }}" method="POST">
        @csrf
        <input name="id_actual" type="hidden" value="{{ $socio->id }}" />
        
        {{-- Nombre --}}
        <div class="mb-3">
            <label for="idnombre" class="form-label @error('nombre') text-danger @enderror">Nombre Completo</label>
            <input {{ $disabled }} value="{{ old('nombre', $socio->nombre) }}" type="text" name="nombre" class="form-control @error('nombre') is-invalid @enderror" id="idnombre">
            @error('nombre') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        {{-- DNI --}}
        <div class="mb-3">
            <label for="iddni" class="form-label @error('dni') text-danger @enderror">DNI</label>
            <input {{ $disabled }} value="{{ old('dni', $socio->dni) }}" type="text" name="dni" class="form-control @error('dni') is-invalid @enderror" id="iddni">
            @error('dni') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        {{-- Edad --}}
        <div class="mb-3">
            <label for="idedad" class="form-label @error('edad') text-danger @enderror">Edad</label>
            <input {{ $disabled }} value="{{ old('edad', $socio->edad) }}" type="number" name="edad" class="form-control @error('edad') is-invalid @enderror" id="idedad">
            @error('edad') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        {{-- Categoría --}}
        <div class="mb-3">
            <label for="idcategoria" class="form-label @error('categoria') text-danger @enderror">Categoría</label>
            <select {{ $disabled }} class="form-select @error('categoria') is-invalid @enderror" id="idcategoria" name="categoria">
                <option value=""></option>
                @foreach ($categorias as $clave => $texto)    
                    <option value="{{ $clave }}" {{ old('categoria', $socio->categoria) == $clave ? 'selected' : '' }}>{{ $texto }}</option>
                @endforeach
            </select>
            @error('categoria') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        {{-- IBAN --}}
        <div class="mb-3">
            <label for="idiban" class="form-label @error('iban') text-danger @enderror">IBAN</label>
            <input {{ $disabled }} value="{{ old('iban', $socio->iban) }}" type="text" name="iban" class="form-control @error('iban') is-invalid @enderror" id="idiban">
            @error('iban') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        @if (!$disabled)
            <button type="submit" class="btn btn-primary">Guardar Cambios</button>
        @endif

        @if ($oper == 'destroy' && (empty($datos['exito'])))
            <button type="submit" class="btn btn-danger">Borrar Socio</button>
        @endif
    </form>
    
    <hr>

    @if(request()->ajax() || request()->input('modo') == 'ajax')
        <button type="button" class="btn btn-secondary mt-3" data-bs-dismiss="modal">Volver</button>
    @else
        <a class="btn btn-info mt-3" href="{{ route('socio.index') }}">Volver al listado</a>
    @endif
</div>

@if(request()->input('modo') == 'ajax')
    @php die(); @endphp
@else
    @endsection
@endif