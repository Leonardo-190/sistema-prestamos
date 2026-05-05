@extends('layouts.main')

@section('title', 'Editar Alumno - Sistema de Préstamos')

@section('content')
    <div class="page-header">
        <h1>Editar Alumno</h1>
        <p>Modifica la información del alumno seleccionado.</p>
    </div>

    <div class="section">
        <div class="section-title">
            <i class="fas fa-user-edit"></i>
            Formulario de Edición de Alumno
        </div>
        <form action="{{ route('alumnos.update', $alumno->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="matricula" class="form-label">Matrícula</label>
                <input type="text" class="form-control bg-dark text-white border-secondary" id="matricula" name="matricula" value="{{ $alumno->matricula }}" required>
            </div>
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre</label>
                <input type="text" class="form-control bg-dark text-white border-secondary" id="nombre" name="nombre" value="{{ $alumno->nombre }}" required>
            </div>
            <div class="mb-3">
                <label for="apellido_paterno" class="form-label">Apellido Paterno</label>
                <input type="text" class="form-control bg-dark text-white border-secondary" id="apellido_paterno" name="apellido_paterno" value="{{ $alumno->apellido_paterno }}" required>
            </div>
            <div class="mb-3">
                <label for="apellido_materno" class="form-label">Apellido Materno</label>
                <input type="text" class="form-control bg-dark text-white border-secondary" id="apellido_materno" name="apellido_materno" value="{{ $alumno->apellido_materno }}">
            </div>
            <div class="mb-3">
                <label for="carrera" class="form-label">Carrera</label>
                <input type="text" class="form-control bg-dark text-white border-secondary" id="carrera" name="carrera" value="{{ $alumno->carrera }}" required>
            </div>
            <div class="mb-3">
                <label for="correo" class="form-label">Correo Electrónico</label>
                <input type="email" class="form-control bg-dark text-white border-secondary" id="correo" name="correo" value="{{ $alumno->correo }}" required>
            </div>
            <div class="mb-3">
                <label for="telefono" class="form-label">Teléfono</label>
                <input type="text" class="form-control bg-dark text-white border-secondary" id="telefono" name="telefono" value="{{ $alumno->telefono }}">
            </div>
            <button type="submit" class="btn-primary-custom"><i class="fas fa-save"></i> Actualizar Alumno</button>
            <a href="{{ route('alumnos.index') }}" class="btn btn-secondary ms-2"><i class="fas fa-arrow-left"></i> Cancelar</a>
        </form>
    </div>
@endsection
