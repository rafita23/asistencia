@extends('layouts.admin')

@section('content')
<div class="content p-4">
    <h1 class="mb-4">Datos del estudiante</h1>
    
    <div class="row">
        <div class="col-lg-12 mx-auto">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h3 class="card-title mb-0"><b>Datos</b></h3>
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        <!-- Nombre Completo -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nombre_completo" class="form-label">Nombre Completo</label>
                                <input type="text" name="nombre_completo" value="{{ $mienbro->nombre_completo }}" class="form-control" readonly>
                            </div>
                        </div>

                        <!-- Dirección -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="direccion" class="form-label">Dirección</label>
                                <input type="text" name="direccion" value="{{ $mienbro->direccion }}" class="form-control" readonly>
                            </div>
                        </div>
                    </div>

                    <div class="row g-3 mt-3">
                        <!-- Teléfono -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="telefono" class="form-label">Teléfono</label>
                                <input type="number" name="telefono" value="{{ $mienbro->telefono }}" class="form-control" readonly>
                            </div>
                        </div>

                        <!-- Fecha de Nacimiento -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="fecha_nacimiento" class="form-label">Fecha de Nacimiento</label>
                                <input type="date" name="fecha_nacimiento" value="{{ $mienbro->fecha_nacimiento }}" class="form-control" readonly>
                            </div>
                        </div>
                    </div>

                    <div class="row g-3 mt-3">
                        <!-- Género -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="genero" class="form-label">Género</label>
                                <input type="text" name="genero" value="{{ $mienbro->genero == 'M' ? 'Masculino' : 'Femenino' }}" class="form-control" readonly>
                            </div>
                        </div>

                        <!-- Grado -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="grado" class="form-label">Grado</label>
                                <input type="text" name="grado" value="{{ $mienbro->grado->nombre_curso }}" class="form-control" readonly>
                            </div>
                        </div>
                    </div>

                    <div class="row g-3 mt-3">
                        <!-- Email -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" name="email" value="{{ $mienbro->email }}" class="form-control" readonly>
                            </div>
                        </div>

                        <!-- Fotografía -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Fotografía</label> <br>
                                @if(empty($mienbro->fotografia))
                                    @if($mienbro->genero == 'M')
                                        <img src="{{ url('images/avatarH.jpg') }}" alt="Avatar Hombre">
                                    @else
                                        <img src="{{ url('images/avatarM.jpg') }}"  alt="Avatar Mujer">
                                    @endif
                                @else
                                    <img src="{{ asset('storage/' . $mienbro->fotografia) }}" width="150px" alt="Fotografía del Estudiante">
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-end mt-4">
                        <a href="{{ route('mienbros.index') }}" class="btn btn-secondary me-2">Regresar</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
