@extends('layout')
@section('title', 'Listado de socios')
@section('contenido')

<div class="container pt-4">
    <table class="table">
        <thead>
            <tr>
                <th scope="col">Acciones</th>
                <th scope="col">Nombre</th>
                <th scope="col">DNI</th>
                <th scope="col">Edad</th>
                <th scope="col">Categoría</th>
                <th scope="col">IBAN</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($socios as $socio)       
                <tr>
                    <th>
                        <button onclick="cargarOperacionSocio('{{ $socio->id }}', 'show')" class="btn btn-primary"><i class="bi bi-search"></i></button>
                        <button onclick="cargarOperacionSocio('{{ $socio->id }}', 'edit')" class="btn btn-success"><i class="bi bi-pencil-square"></i></button>
                        <button onclick="cargarOperacionSocio('{{ $socio->id }}', 'destroy')" class="btn btn-danger"><i class="bi bi-trash"></i></button>
                    </th>
                    <td>{{ $socio->nombre }}</td>
                    <td>{{ $socio->dni }}</td>
                    <td>{{ $socio->edad }}</td>
                    <td>{{ $categorias[$socio->categoria] ?? $socio->categoria }}</td>
                    <td>{{ $socio->iban }}</td>
                </tr>
            @endforeach

                {{ $socios->links() }}

        </tbody>
    </table>
    
    
    <button type="button" class="btn btn-primary" onclick="cargarOperacionSocio('', 'create')">Nuevo Socio</button>
</div>

<div class="modal fade" id="ventanaModalSocio" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div id="contenidoModalSocio" class="modal-body">
                </div>
        </div>
    </div>
</div>

<script>
const CSRF_TOKEN_SOCIO = '{{ csrf_token() }}';

function cargarOperacionSocio(id, operacion) {
    let url = (operacion === 'create') ? '/socio/create' : `/socio/${operacion}/${id}`;
    
    fetch(url + '?modo=ajax')
        .then(res => res.text())
        .then(html => {
            document.getElementById('contenidoModalSocio').innerHTML = html;
            new bootstrap.Modal(document.getElementById('ventanaModalSocio')).show();
        });
}

document.addEventListener('submit', function(e) {
    if (e.target && e.target.closest('#contenidoModalSocio')) {
        e.preventDefault();
        const form = e.target;
        const formData = new FormData(form);
        formData.append('modo', 'ajax');

        fetch(form.action, {
            method: 'POST',
            headers: { 'X-XSRF-TOKEN': CSRF_TOKEN_SOCIO },
            body: formData
        })
        .then(res => res.text())
        .then(html => {
            document.getElementById('contenidoModalSocio').innerHTML = html;
        });
    }
});

// Recarga al cerrar para ver cambios
document.addEventListener('DOMContentLoaded', function() {
    const elModal = document.getElementById('ventanaModalSocio');
    if(elModal) {
        elModal.addEventListener('hidden.bs.modal', function () {
            window.location.reload();
        });
    }
});
</script>
@endsection