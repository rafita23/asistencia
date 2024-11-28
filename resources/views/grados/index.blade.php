@extends('layouts.admin')

@section('content')
  <div class='content'>
      <h2>Listado de cursos</h2>

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
                <h3 class="card-title"><b>Cursos Registrados</b></h3>
                <div class="card-tools">
                  <a href="{{url('/grados/create')}}" class="btn btn-primary">
                    <i class="bi bi-file-plus"></i> Agregar nuevo cursos
                  </a>
                </button>
              </div>
              </div>
          
              <!-- /.card-header -->
              <div class="card-body" style="display: block;">
                <table id="example1" class="table table-bordered table-striped table-sm">
                  <thead>
                    <tr>
                      <th>Nro</th>
                      <th>nombre_curspo</th>
                      <th>otro1</th>
                      <th>otro2</th>
                      <th>otro3</th>
                      <th>Acciones</th>
                    </tr>
                  </thead>
                  <tbody>
                      <?php $conta = 0; ?>
                      @foreach($grados as $grado)
                          <tr>
                              <td>{{ ++$conta }}</td>
                              <td>{{ $grado->nombre_curso }}</td>
                              <td>{{ $grado->otro1 }}</td>
                              <td>{{ $grado->otro2 }}</td>
                              <td>{{ $grado->otro3 }}</td>
                              <td>
                                <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                                  <a href="{{ url('grados', $grado->id) }}" class="btn btn-info">
                                      <i class="fas fa-eye"></i>
                                  </a>
                                  <a href="{{ route('grados.edit',$grado->id) }}" class="btn btn-warning">
                                      <i class="fas fa-edit"></i>
                                  </a>
                                  <form action="{{ route('grados.destroy', $grado->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    {{method_field('DELETE')}}
                                    <button type="submit" class="btn btn-danger">
                                      <i class="fas fa-trash-alt"></i>
                                    </button>
                                  </form>
                                </div>
                              </td>
                          </tr>
                      @endforeach
                  </tbody>
                </table>  
              
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
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
      </div>
  </div>
@endsection
