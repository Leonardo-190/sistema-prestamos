@extends('layouts.main')

@section('title', 'Añadir Equipo - Sistema de Préstamos')

@section('content')
    <div class="page-header">
        <h1>Añadir Nuevo Equipo</h1>
        <p>Completa el formulario para registrar un nuevo equipo en el sistema.</p>
    </div>

    <div class="section">
        <div class="section-title">
            <i class="fas fa-plus-circle"></i>
            Formulario de Equipo
        </div>
        <form action="{{ route('equipos.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre del Equipo</label>
                <input type="text" class="form-control bg-dark text-white border-secondary" id="nombre" name="nombre" required>
            </div>
            <div class="mb-3">
                <label for="tipo" class="form-label">Tipo</label>
                <select class="form-select bg-dark text-white border-secondary" id="tipo" name="tipo" required>
                    <option value="">Selecciona un tipo</option>
                    <option value="Laptop">Laptop</option>
                    <option value="Proyector">Proyector</option>
                    <option value="Bocina">Bocina</option>
                    <option value="Monitor">Monitor</option>
                    <option value="Teclado">Teclado</option>
                    <option value="Mouse">Mouse</option>
                    <option value="Otro">Otro</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="marca" class="form-label">Marca</label>
                <input type="text" class="form-control bg-dark text-white border-secondary" id="marca" name="marca" required>
            </div>
            <div class="mb-3">
                <label for="modelo" class="form-label">Modelo</label>
                <input type="text" class="form-control bg-dark text-white border-secondary" id="modelo" name="modelo">
            </div>
            <div class="mb-3">
                <label for="estado" class="form-label">Estado</label>
                <select class="form-select bg-dark text-white border-secondary" id="estado" name="estado" required>
                    <option value="Disponible">Disponible</option>
                    <option value="Prestado">Prestado</option>
                    <option value="Dañado">Dañado</option>
                </select>
            </div>
            <button type="submit" class="btn-primary-custom"><i class="fas fa-save"></i> Guardar Equipo</button>
            <a href="{{ route('equipos.index') }}" class="btn btn-secondary ms-2"><i class="fas fa-arrow-left"></i> Cancelar</a>
        </form>
    </div>
@endsection
