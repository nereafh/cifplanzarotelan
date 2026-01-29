@extends('layout')
@section('title', 'Listado de libros')
@section('contenido')

<div class="container pt-4">

    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Título</th>
                <th scope="col">Autor</th>
                <th scope="col">Género</th>
                <th scope="col">Año</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($libros as $libro)       
            


                <tr>
                    <th>
                        <button onclick="cargarOperacion('{{ $libro->id }}', 'show')" class="btn btn-primary"><i class="bi bi-search"></i></button>
                        <button onclick="cargarOperacion('{{ $libro->id }}', 'edit')" class="btn btn-success"><i class="bi bi-pencil-square"></i></button>
                        <button onclick="cargarOperacion('{{ $libro->id }}', 'destroy')" class="btn btn-danger"><i class="bi bi-trash"></i></button>
                    </th>
                    <td>{{ $libro->titulo }}</td>
                    <td>{{ $libro->autor }}</td>
                    <td>{{ $cods_genero[trim($libro->genero)] ?? 'Error con la clave: ['.$libro->genero.']' }}</td>
                    <!--  {{ $cods_genero[$libro->genero] }} -->
                    <td>{{ $libro->anho }}</td>
                </tr>
            @endforeach

            {{ $libros->links() }}



        </tbody>
    </table>
    {{ $libros->links() }}
    <button type="button" class="btn btn-primary" onclick="cargarOperacion('', 'create')">Nuevo Libro</button>


</div>

<div class="modal fade" id="ventanaModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div id="contenidoModal" class="modal-body">
                </div>
        </div>
    </div>
</div>
<script>
const CSRF_TOKEN = '{{ csrf_token() }}';

function cargarOperacion(id, operacion) {
    let url = (operacion === 'create') ? '/libro/create' : `/libro/${operacion}/${id}`;
    
    fetch(url + '?modo=ajax')
        .then(res => res.text())
        .then(html => {
            document.getElementById('contenidoModal').innerHTML = html;
            new bootstrap.Modal(document.getElementById('ventanaModal')).show();
        });
}

document.addEventListener('submit', function(e) {
    if (e.target && e.target.closest('#contenidoModal')) {
        e.preventDefault();
        const form = e.target;
        const formData = new FormData(form);
        formData.append('modo', 'ajax');

        fetch(form.action, {
            method: 'POST',
            headers: { 'X-CSRF-TOKEN': CSRF_TOKEN },
            body: formData
        })
        .then(res => res.text())
        .then(html => {
            document.getElementById('contenidoModal').innerHTML = html;
        });
    }
});

// Recarga al cerrar modal para ver cambios en la tabla
document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('ventanaModal').addEventListener('hidden.bs.modal', function () {
        window.location.reload();
    });
});
</script>
@endsection