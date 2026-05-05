@extends('layouts.main')

@section('title', 'Editar Equipo - Sistema de Préstamos')

@section('content')
    <div class="page-header">
        <h1>Editar Equipo</h1>
        <p>Modifica la información del equipo seleccionado.</p>
    </div>

    <div class="section">
        <div class="section-title">
            <i class="fas fa-edit"></i>
            Formulario de Edición de Equipo
        </div>
        <form action="{{ route('equipos.update', $equipo->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre del Equipo</label>
                <input type="text" class="form-control bg-dark text-white border-secondary" id="nombre" name="nombre" value="{{ $equipo->nombre }}" required>
            </div>
            <div class="mb-3">
                <label for="tipo" class="form-label">Tipo</label>
                <select class="form-select bg-dark text-white border-secondary" id="tipo" name="tipo" required>
                    <option value="">Selecciona un tipo</option>
                    <option value="Laptop" {{ $equipo->tipo == 'Laptop' ? 'selected' : '' }}>Laptop</option>
                    <option value="Proyector" {{ $equipo->tipo == 'Proyector' ? 'selected' : '' }}>Proyector</option>
                    <option value="Bocina" {{ $equipo->tipo == 'Bocina' ? 'selected' : '' }}>Bocina</option>
                    <option value="Monitor" {{ $equipo->tipo == 'Monitor' ? 'selected' : '' }}>Monitor</option>
                    <option value="Teclado" {{ $equipo->tipo == 'Teclado' ? 'selected' : '' }}>Teclado</option>
                    <option value="Mouse" {{ $equipo->tipo == 'Mouse' ? 'selected' : '' }}>Mouse</option>
                    <option value="Otro" {{ $equipo->tipo == 'Otro' ? 'selected' : '' }}>Otro</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="marca" class="form-label">Marca</label>
                <input type="text" class="form-control bg-dark text-white border-secondary" id="marca" name="marca" value="{{ $equipo->marca }}" required>
            </div>
            <div class="mb-3">
                <label for="modelo" class="form-label">Modelo</label>
                <input type="text" class="form-control bg-dark text-white border-secondary" id="modelo" name="modelo" value="{{ $equipo->modelo }}">
            </div>
            <div class="mb-3">
                <label for="estado" class="form-label">Estado</label>
                <select class="form-select bg-dark text-white border-secondary" id="estado" name="estado" required>
                    <option value="Disponible" {{ $equipo->estado == 'Disponible' ? 'selected' : '' }}>Disponible</option>
                    <option value="Prestado" {{ $equipo->estado == 'Prestado' ? 'selected' : '' }}>Prestado</option>
                    <option value="Dañado" {{ $equipo->estado == 'Dañado' ? 'selected' : '' }}>Dañado</option>
                </select>
            </div>
            <button type="submit" class="btn-primary-custom"><i class="fas fa-save"></i> Actualizar Equipo</button>
            <a href="{{ route('equipos.index') }}" class="btn btn-secondary ms-2"><i class="fas fa-arrow-left"></i> Cancelar</a>
        </form>
    </div>
@endsection
