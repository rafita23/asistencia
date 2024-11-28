@extends('layouts.admin')

@section('content')
<div class="content p-4">
    <h1 class="mb-4">Actualizar datos del curso</h1>
    
    <div class="row">
        <div class="col-lg-12 mx-auto">
            <div class="card shadow-sm">
                <div class="card-header bg-success text-white">
                    <h3 class="card-title mb-0"><b>Datos</b></h3>
                </div>
                <div class="card-body">
                    <form action="{{ url('/grados',$grado->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    {{method_field('PATCH')}}
                        <div class="row g-3">
                            <!-- Nombre Completo -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nombre_curso" class="form-label">Nombre del curso</label>
                                    <input type="text" name="nombre_curso" value="{{ $grado->nombre_curso }}" class="form-control">
                                </div>
                            </div>

                            <!-- Dirección -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="otro1" class="form-label">Otro1</label>
                                    <input type="text" name="otro1" value="{{ $grado->otro1 }}" class="form-control">
                                </div>
                            </div>
                        </div>

                        <div class="row g-3 mt-3">
                            <!-- Teléfono -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="otro2" class="form-label">Otro2</label>
                                    <input type="text" name="otro2" value="{{ $grado->otro2 }}" class="form-control">
                                </div>
                            </div>

                            <!-- Fecha de Nacimiento -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="otro3" class="form-label">Otro3</label>
                                    <input type="text" name="otro3" value="{{ $grado->otro3 }}" class="form-control">
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-end mt-4">
                            <a href="{{ route('grados.index') }}" class="btn btn-secondary me-2">Regresar</a>
                            <button type="submit" class="btn btn-success">Actualizar</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
