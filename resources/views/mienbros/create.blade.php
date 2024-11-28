@extends('layouts.admin')

@section('content')
<div class="content p-4">
    <h1 class="mb-4">Creación de Estudiantes</h1>
    
    <div class="row">
        <div class="col-lg-12 mx-auto">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h3 class="card-title mb-0"><b>Insertar Datos</b></h3>
                </div>
                <div class="card-body">
                  <form action="{{ url('/mienbros') }}" method="post" enctype="multipart/form-data">
                    @csrf
                        <div class="row g-3">
                            <!-- Nombre Completo -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nombre_completo" class="form-label">Nombre Completo</label><b>*</b>
                                    <input type="text" name="nombre_completo" value="{{old('nombre_completo')}}" class="form-control" required placeholder="Ej. Juan Pérez">
                                    @error('nombre_completo')
                                    <small style='color: red'>* Este campo es requerido</small>
                                    @enderror
                                </div>
                            </div>
                            <!-- Dirección -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="direccion" class="form-label">Dirección</label><b>*</b>
                                    <input type="text" name="direccion" value="{{old('direccion')}}" class="form-control" placeholder="Ej. Calle 123" required>
                                    @error('direccion')
                                    <small style='color: red'>* Este campo es requerido</small>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row g-3 mt-3">
                            <!-- Teléfono -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="telefono" class="form-label">Teléfono</label><b>*</b>
                                    <input type="number" name="telefono" value="{{old('telefono')}}" class="form-control" placeholder="Ej. 12345678" required>
                                    @error('telefono')
                                    <small style='color: red'>* Este campo es requerido</small>
                                    @enderror
                                </div>
                            </div>
                            <!-- Fecha de Nacimiento -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="fecha_nacimiento" class="form-label">Fecha de Nacimiento</label><b>*</b>
                                    <input type="date" name="fecha_nacimiento" value="{{old('fecha_nacimiento')}}" class="form-control" required>
                                    @error('fecha_nacimiento')
                                    <small style='color: red'>* Este campo es requerido</small>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row g-3 mt-3">
                            <!-- Género -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="genero" class="form-label">Género</label><b>*</b>
                                    <select name="genero" value="{{old('genero')}}" class="form-select">
                                        <option value="">Seleccione</option>
                                        <option value="M">M</option>
                                        <option value="F">F</option>
                                    </select>
                                    @error('genero')
                                    <small style='color: red'>* Este campo es requerido</small>
                                    @enderror
                                </div>
                            </div>
                            <!-- Grado -->
                            <div class="col-md-6">
                            <div class="form-group">
                                <label for="grado_id" class="form-label">Grado</label><b>*</b>
                                <select name="grado_id" class="form-select" required>
                                    <option value="">Seleccione</option>
                                    @foreach($grados as $grado)
                                        <option value="{{ $grado->id }}" {{ old('grado_id') == $grado->id ? 'selected' : '' }}>
                                            {{ $grado->nombre_curso }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('grado_id')
                                    <small style="color: red">* Este campo es requerido</small>
                                @enderror
                            </div>
                            </div>
                        </div>

                        <div class="row g-3 mt-3">
                            <!-- Email -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="email" class="form-label">Email</label><b>*</b>
                                    <input type="email" name="email" value="{{old('email')}}" class="form-control" placeholder="Ej. ejemplo@correo.com" required>
                                    @error('email')
                                    <small style='color: red'>* Este campo es requerido</small>
                                    @enderror
                                </div>
                            </div>
                            <!-- Fotografía -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="fotografia" class="form-label">Fotografía <b>*</b></label>
                                    <input type="file" id="file" name="fotografia" class="form-control" accept="image/*">
                                </div>
                                <!-- Contenedor para la previsualización de la imagen -->
                                <div id="preview" class="mt-3"></div>
                            </div>

                            <script>
                                document.getElementById('file').addEventListener('change', function (evt) {
                                    const files = evt.target.files; // Archivos seleccionados
                                    const output = document.getElementById("preview"); // Contenedor de previsualización
                                    output.innerHTML = ""; // Limpiar previsualización anterior

                                    if (!files.length) {
                                        output.innerHTML = `<small class="text-muted">No se ha seleccionado ninguna imagen.</small>`;
                                        return;
                                    }

                                    const file = files[0];

                                    // Verificar si el archivo es una imagen
                                    if (!file.type.match('image.*')) {
                                        output.innerHTML = `<div class="alert alert-warning" role="alert">
                                            El archivo seleccionado no es una imagen válida.
                                        </div>`;
                                        return;
                                    }

                                    // Crear previsualización de la imagen
                                    const reader = new FileReader();
                                    reader.onload = function (e) {
                                        output.innerHTML = `
                                            <img src="${e.target.result}" class="img-fluid rounded shadow-sm" alt="Previsualización" style="max-width: 100%; height: auto;">
                                        `;
                                    };
                                    reader.readAsDataURL(file); // Leer contenido del archivo como DataURL
                                });
                            </script>


                        </div>

                        <div class="d-flex justify-content-end mt-4">
                            <a href="#" class="btn btn-secondary me-2">Cancelar</a>
                            <button type="submit" class="btn btn-primary">Guardar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
