@extends('layouts.admin')

@section('content')
<div class="content p-4">
    <h1 class="mb-4">Creación de Cursos</h1>
    
    <div class="row">
        <div class="col-lg-12 mx-auto">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h3 class="card-title mb-0"><b>Insertar Datos</b></h3>
                </div>
                <div class="card-body">
                  <form action="{{ url('/grados') }}" method="post" enctype="multipart/form-data">
                    @csrf
                        <div class="row g-3">
                            <!-- Nombre Curso -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nombre_curso" class="form-label">Nombre del Curso</label><b>*</b>
                                    <input type="text" name="nombre_curso" value="{{old('nombre_curso')}}" class="form-control" required placeholder="Ej. robotica">
                                    @error('nombre_curso')
                                    <small style='color: red'>* Este campo es requerido</small>
                                    @enderror
                                </div>
                            </div>
                            <!-- Dirección -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="otro1" class="form-label">Otro1</label><b>*</b>
                                    <input type="text" name="otro1" value="{{old('otro1')}}" class="form-control" placeholder="Ej. otro1" required>
                                    @error('otro1')
                                    <small style='color: red'>* Este campo es requerido</small>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row g-3 mt-3">
                            <!-- Teléfono -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="otro2" class="form-label">Otro2</label><b>*</b>
                                    <input type="text" name="otro2" value="{{old('otro2')}}" class="form-control" placeholder="Ej. otro2" required>
                                    @error('otro2')
                                    <small style='color: red'>* Este campo es requerido</small>
                                    @enderror
                                </div>
                            </div>
                            <!-- Fecha de Nacimiento -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="otro3" class="form-label">Otro3</label><b>*</b>
                                    <input type="text" name="otro3" value="{{old('otro3')}}" class="form-control" placeholder="Ej. otro3" required>
                                    @error('otro3')
                                    <small style='color: red'>* Este campo es requerido</small>
                                    @enderror
                                </div>
                            </div>
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
