@extends('layouts.admin')

@section('content')
<div class="content p-4">
    <h1 class="mb-4">Actualizar datos del estudiante</h1>
    
    <div class="row">
        <div class="col-lg-12 mx-auto">
            <div class="card shadow-sm">
                <div class="card-header bg-success text-white">
                    <h3 class="card-title mb-0"><b>Datos</b></h3>
                </div>
                <div class="card-body">
                    <form action="{{ url('/mienbros',$mienbro->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    {{method_field('PATCH')}}
                        <div class="row g-3">
                            <!-- Nombre Completo -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nombre_completo" class="form-label">Nombre Completo</label>
                                    <input type="text" name="nombre_completo" value="{{ $mienbro->nombre_completo }}" class="form-control">
                                </div>
                            </div>

                            <!-- Dirección -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="direccion" class="form-label">Dirección</label>
                                    <input type="text" name="direccion" value="{{ $mienbro->direccion }}" class="form-control">
                                </div>
                            </div>
                        </div>

                        <div class="row g-3 mt-3">
                            <!-- Teléfono -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="telefono" class="form-label">Teléfono</label>
                                    <input type="number" name="telefono" value="{{ $mienbro->telefono }}" class="form-control">
                                </div>
                            </div>

                            <!-- Fecha de Nacimiento -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="fecha_nacimiento" class="form-label">Fecha de Nacimiento</label>
                                    <input type="date" name="fecha_nacimiento" value="{{ $mienbro->fecha_nacimiento }}" class="form-control">
                                </div>
                            </div>
                        </div>

                        <div class="row g-3 mt-3">
                            <!-- Género -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="genero" class="form-label">Género</label><b>*</b>
                                    <select name="genero" class="form-select">
                                        <option value="">Seleccione</option>
                                        <option value="M" {{ old('genero', $mienbro->genero) == 'M' ? 'selected' : '' }}>M</option>
                                        <option value="F" {{ old('genero', $mienbro->genero) == 'F' ? 'selected' : '' }}>F</option>
                                    </select>
                                    @error('genero')
                                        <small style="color: red">* Este campo es requerido</small>
                                    @enderror
                                </div>
                            </div>


                            <!-- Grado -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="grado_id" class="form-label">Grado</label>
                                    <select name="grado_id" class="form-select">
                                        <option value="">Seleccione un grado</option>
                                        @foreach ($grados as $grado)
                                            <option value="{{ $grado->id }}" 
                                                {{ $mienbro->grado_id == $grado->id ? 'selected' : '' }}>
                                                {{ $grado->nombre_curso }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row g-3 mt-3">
                            <!-- Email -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" name="email" value="{{ $mienbro->email }}" class="form-control">
                                </div>
                            </div>

                            <!-- Fotografía -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="fotografia" class="form-label">Fotografía <b>*</b></label>
                                    <input type="file" id="file" name="fotografia" class="form-control" accept="image/*">
                                    <center>
                                        <ouput id="list">
                                        @if(empty($mienbro->fotografia))
                                        @if($mienbro->genero == 'M')
                                            <img src="{{ url('images/avatarH.jpg') }}" alt="Avatar Hombre">
                                        @else
                                            <img src="{{ url('images/avatarM.jpg') }}"  alt="Avatar Mujer">
                                        @endif
                                        @else
                                        <center>
                                            <img src="{{ asset('storage/' . $mienbro->fotografia) }}" width="150px" alt="Fotografía del Estudiante">
                                        </center>
                                        @endif
                                        </ouput>
                                   </center>
                                </div>
                            </div>

                            <script>
                              document.getElementById('file').addEventListener('change', function (evt) {
                                  const files = evt.target.files;
                                  const output = document.getElementById("list");
                                  output.innerHTML = ""; // Limpiar la previsualización anterior

                                  if (!files.length) {
                                      output.innerHTML = `<small class="text-muted">No se ha seleccionado ninguna imagen.</small>`;
                                      return;
                                  }

                                  const file = files[0];
                                  // Verificar si es una imagen
                                  if (!file.type.match('image.*')) {
                                      output.innerHTML = `<div class="alert alert-warning" role="alert">
                                          El archivo seleccionado no es una imagen válida.
                                      </div>`;
                                      return;
                                  }

                                  const reader = new FileReader();
                                  reader.onload = function (e) {
                                      output.innerHTML = `
                                          <img src="${e.target.result}" class="img-fluid rounded shadow-sm" alt="Previsualización" width="50%">
                                      `;
                                  };
                                  reader.readAsDataURL(file);
                              });
                            </script>
                        </div>

                        <div class="d-flex justify-content-end mt-4">
                            <a href="{{ route('mienbros.index') }}" class="btn btn-secondary me-2">Regresar</a>
                            <button type="submit" class="btn btn-success">Actualizar</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
