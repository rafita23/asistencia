@extends('layouts.admin')

@section('content')
<div class="container">
    <h1 class="mb-4">Gestión de Asistencias</h1>
    
    <!-- Alertas de éxito o error -->
    <div id="alertContainer"></div>
    
    <!-- Selector de grados -->
    <div class="form-group mb-4">
        <label for="grado" class="form-label"><strong>Selecciona un Grado:</strong></label>
        <select id="grado" class="form-select">
            <option value="">-- Selecciona un Grado --</option>
            @foreach($grados as $grado)
                <option value="{{ $grado->id }}">{{ $grado->nombre_curso }}</option>
            @endforeach
        </select>
    </div>

    <!-- Tabla de estudiantes -->
    <form id="asistenciaForm" class="card shadow">
        @csrf
        <div class="card-header bg-primary text-white">
            <strong>Lista de Estudiantes</strong>
        </div>
        <div class="card-body p-0">
            <table class="table table-striped table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th>Nombre</th>
                        <th>Teléfono</th>
                        <th class="text-center">Presente</th>
                        <th>WhatsApp</th>
                    </tr>
                </thead>
                <tbody id="estudiantes">
                    <tr>
                        <td colspan="4" class="text-center py-3">Selecciona un grado para cargar los estudiantes.</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="card-footer d-flex justify-content-end">
            <a href="{{ route('mienbros.index') }}" class="btn btn-secondary me-2">Regresar</a>
            <button type="submit" class="btn btn-primary">Guardar Asistencia</button>
        </div>
    </form>
</div>

<script>
    document.getElementById('grado').addEventListener('change', function () {
        const gradoId = this.value;
        const estudiantesTbody = document.getElementById('estudiantes');
        estudiantesTbody.innerHTML = `
            <tr>
                <td colspan="4" class="text-center py-3">Cargando estudiantes...</td>
            </tr>
        `;

        if (gradoId) {
            fetch(`/asistencias/estudiantes/${gradoId}`)
                .then(response => response.json())
                .then(data => {
                    estudiantesTbody.innerHTML = '';
                    if (data.length > 0) {
                        data.forEach(estudiante => {
                            const telefono = estudiante.telefono || 'Sin teléfono';
                            const whatsappLink = telefono !== 'Sin teléfono'
                                ? `https://wa.me/591${telefono}?text=Hola ${estudiante.nombre_completo}, este es un mensaje relacionado con tu asistencia.`
                                : '#';

                            estudiantesTbody.innerHTML += `
                                <tr>
                                    <td>${estudiante.nombre_completo}</td>
                                    <td>${telefono}</td>
                                    <td class="text-center">
                                        <input type="hidden" name="asistencia[${estudiante.id}][mienbro_id]" value="${estudiante.id}">
                                        <input type="checkbox" name="asistencia[${estudiante.id}][asistio]" value="1" checked>
                                    </td>
                                    <td class="text-center">
                                        <a href="${whatsappLink}" class="btn btn-success btn-sm" target="_blank" ${telefono === 'Sin teléfono' ? 'disabled' : ''}>
                                            <i class="bi bi-whatsapp"></i> Enviar
                                        </a>
                                    </td>
                                </tr>
                            `;
                        });
                    } else {
                        estudiantesTbody.innerHTML = `
                            <tr>
                                <td colspan="4" class="text-center py-3">No se encontraron estudiantes para este grado.</td>
                            </tr>
                        `;
                    }
                })
                .catch(() => {
                    estudiantesTbody.innerHTML = `
                        <tr>
                            <td colspan="4" class="text-center text-danger py-3">Error al cargar los estudiantes.</td>
                        </tr>
                    `;
                });
        } else {
            estudiantesTbody.innerHTML = `
                <tr>
                    <td colspan="4" class="text-center py-3">Selecciona un grado para cargar los estudiantes.</td>
                </tr>
            `;
        }
    });

    document.getElementById('asistenciaForm').addEventListener('submit', function (e) {
        e.preventDefault();
        const formData = new FormData(this);
        fetch('/asistencias', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
            },
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            showAlert('success', data.success);
            document.getElementById('grado').dispatchEvent(new Event('change')); // Recargar lista
        })
        .catch(error => {
            console.error('Error:', error);
            showAlert('danger', 'Ocurrió un error al guardar la asistencia.');
        });
    });

    function showAlert(type, message) {
        const alertContainer = document.getElementById('alertContainer');
        alertContainer.innerHTML = `
            <div class="alert alert-${type} alert-dismissible fade show" role="alert">
                ${message}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        `;
        setTimeout(() => alertContainer.innerHTML = '', 5000);
    }
</script>
@endsection
