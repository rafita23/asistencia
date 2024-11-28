@extends('layouts.admin')

@section('content')
<div class='content'>
    <h2>Gestión de Asistencias</h2>

    @if($message = Session::get('mensaje'))
        <script>
            Swal.fire({
                position: "top-end",
                icon: "success",
                title: "{{$message}}",
                showConfirmButton: false,
                timer: 1500
            });
        </script>
    @endif

    <div class='row'>
        <div class="col-md-12">
            <div class="card card-outline card-primary">
                <div class="card-header">
                    <h3 class="card-title"><b>Seleccionar Fecha y Grado</b></h3>
                </div>
                <div class="card-body">
                    <form id="filtersForm">
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="fecha" class="form-label"><b>Fecha:</b></label>
                                <input type="date" id="fecha" class="form-control" value="{{ date('Y-m-d') }}">
                            </div>
                            <div class="col-md-6">
                                <label for="grado" class="form-label"><b>Grado:</b></label>
                                <select id="grado" class="form-select">
                                    <option value="">-- Selecciona un Grado --</option>
                                    @foreach($grados as $grado)
                                        <option value="{{ $grado->id }}">{{ $grado->nombre_curso }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-12">
            <div class="card card-outline card-primary">
                <div class="card-header">
                    <h3 class="card-title"><b>Listado de Asistencias</b></h3>
                </div>
                <div class="card-body">
                    <table id="asistenciasTable" class="table table-bordered table-striped table-sm">
                        <thead>
                            <tr>
                                <th>Nro</th>
                                <th>Nombre</th>
                                <th>Teléfono</th>
                                <th>Asistió</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td colspan="5" class="text-center py-3">Selecciona una fecha y un grado para cargar las asistencias.</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.getElementById('grado').addEventListener('change', loadAsistencias);
    document.getElementById('fecha').addEventListener('change', loadAsistencias);

    function loadAsistencias() {
        const fecha = document.getElementById('fecha').value;
        const gradoId = document.getElementById('grado').value;
        const table = $('#asistenciasTable').DataTable();

        if (fecha && gradoId) {
            table.clear().draw(); // Limpia la tabla antes de cargar nuevos datos
            fetch(`/asistencias/grados/${gradoId}/${fecha}`)
                .then(response => response.json())
                .then(data => {
                    if (data.length > 0) {
                        data.forEach((asistencia, index) => {
                            const telefono = asistencia.telefono || 'Sin teléfono';
                            const asistio = asistencia.asistio ? 'Sí' : 'No';
                            table.row.add([
                                index + 1,
                                asistencia.nombre_completo,
                                telefono,
                                asistio,
                                `
                                    <a href="{{ url('mienbros') }}/${asistencia.id}" class="btn btn-info">
                                        <i class="fas fa-eye"></i> Ver
                                    </a>
                                `
                            ]).draw();
                        });
                    } else {
                        table.row.add([
                            '',
                            '',
                            '',
                            '',
                            '<td colspan="5" class="text-center py-3">No se encontraron asistencias para esta fecha y grado.</td>'
                        ]).draw();
                    }
                })
                .catch(() => {
                    table.row.add([
                        '',
                        '',
                        '',
                        '',
                        '<td colspan="5" class="text-center text-danger py-3">Error al cargar las asistencias.</td>'
                    ]).draw();
                });
        } else {
            table.clear().draw(); // Limpia la tabla si no hay filtros
            table.row.add([
                '',
                '',
                '',
                '',
                '<td colspan="5" class="text-center py-3">Selecciona una fecha y un grado para cargar las asistencias.</td>'
            ]).draw();
        }
    }

    $(function () {
        $('#asistenciasTable').DataTable({
            "pageLength": 10,
            "language": {
                "emptyTable": "No hay información",
                "info": "Mostrando _START_ a _END_ de _TOTAL_ registros",
                "infoEmpty": "Mostrando 0 a 0 de 0 registros",
                "infoFiltered": "(filtrado de _MAX_ registros totales)",
                "search": "Buscar:",
                "zeroRecords": "No se encontraron resultados",
                "paginate": {
                    "first": "Primero",
                    "last": "Último",
                    "next": "Siguiente",
                    "previous": "Anterior"
                }
            },
            "responsive": true,
            "lengthChange": true,
            "autoWidth": false,
            "buttons": [
                "copy", "csv", "excel", "pdf", "print", "colvis"
            ]
        }).buttons().container().appendTo('#asistenciasTable_wrapper .col-md-6:eq(0)');
    });
</script>
 <!-- Page specific script -->
                <script>
                  $(function () {
                    $("#example1").DataTable({
                      "pageLength": 10, 
                      "language": { 
                        "emptyTable": "No hay información", 
                        "info": "Mostrando _START_ a _END_ de _TOTAL_ Estudiantes", 
                        "infoEmpty": "Mostrando 0 a 0 de 0 Estudiantes", 
                        "infoFiltered": "(Filtrado de _MAX_ total Estuciantes)", 
                        "infoPostFix": "", 
                        "thousands": ",", 
                        "lengthMenu": "Mostrar _MENU_ Estudiantes ", 
                        "loadingRecords": "Cargando...", 
                        "processing": "Procesando...", 
                        "search": "Buscador:", 
                        "zeroRecords": "Sin resultados encontrados", 
                        "paginate": { 
                          "first": "Primero", 
                          "last": "Último", 
                          "next": "Siguiente", 
                          "previous": "Anterior" 
                        } 
                      },
                      "responsive": true, "lengthChange": true, "autoWidth": false, 
                      "buttons": [{ 
                        "extend": "collection", 
                        "text": "Reportes", 
                        "orientation": "landscape", 
                        "buttons": [{ 
                          "text": "Copiar", 
                          "extend": "copy" 
                        }, { 
                          "extend": "pdf" 
                        }, { 
                          "extend": "csv" 
                        }, {
                          "extend": "excel" 
                        }, { 
                          "text": "Imprimir", 
                          "extend": "print" 
                        } 
                        ] 
                      }, 
                        {
                          "extend": "colvis",  // Extiende la funcionalidad de visibilidad de columnas
                          "text": "Visor de columnas",  // Texto que se muestra en el botón
                          "collectionLayout": "fixed one-column",  // Disposición de las columnas de la colección en 3 columnas
                          "columnText": function (dt, idx, title) {  // Personaliza cómo se muestra el texto en la colección
                            return title;  // Muestra el nombre de la columna
                          },
                          "columnVisibility": true,  // Asegura que las columnas ocultas también estén disponibles para selección
                          "prefix": "Mostrar/Ocultar columnas: ",  // Prefijo que se añadirá al texto del botón para una mejor descripción
                          "className": "btn btn-info"  // Se agrega una clase CSS para estilizar el botón
                        }
                      ],
                    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
                  });
                </script>
@endsection
