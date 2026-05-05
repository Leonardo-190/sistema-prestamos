@extends('layouts.main')

@section('title', 'Registrar Préstamo - Sistema de Préstamos')

@section('content')
    <div class="page-header">
        <h1><i class="fas fa-plus"></i> Registrar Nuevo Préstamo</h1>
        <p>Asigna un equipo a un alumno</p>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert" style="background: #3a1a1a; border: 1px solid #8b3a3a; color: #ff6b6b;">
            <strong>Por favor, corrige los siguientes errores:</strong>
            <ul style="margin: 0;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="section">
        <div class="section-title">
            <i class="fas fa-form"></i>
            Formulario de Préstamo
        </div>

        <form action="{{ route('prestamos.store') }}" method="POST">
            @csrf

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 20px;">
                <div>
                    <label for="alumno_id" style="color: #ddd; font-weight: 600; margin-bottom: 8px; display: block;">Alumno <span style="color: #dc3545;">*</span></label>
                    <select name="alumno_id" id="alumno_id" class="form-control" style="background: #2a2a2a; border: 1px solid #444; color: #fff; padding: 10px; border-radius: 8px;" required>
                        <option value="">-- Seleccionar Alumno --</option>
                        @foreach ($alumnos as $alumno)
                            <option value="{{ $alumno->id }}" {{ old('alumno_id') == $alumno->id ? 'selected' : '' }}>
                                {{ $alumno->nombre }} ({{ $alumno->matricula }})
                            </option>
                        @endforeach
                    </select>
                    @error('alumno_id')
                        <small style="color: #ff6b6b;">{{ $message }}</small>
                    @enderror
                </div>

                <div>
                    <label for="equipo_id" style="color: #ddd; font-weight: 600; margin-bottom: 8px; display: block;">Equipo Disponible <span style="color: #dc3545;">*</span></label>
                    <select name="equipo_id" id="equipo_id" class="form-control" style="background: #2a2a2a; border: 1px solid #444; color: #fff; padding: 10px; border-radius: 8px;" required>
                        <option value="">-- Seleccionar Equipo --</option>
                        @foreach ($equipos as $equipo)
                            <option value="{{ $equipo->id }}" {{ old('equipo_id') == $equipo->id ? 'selected' : '' }}>
                                {{ $equipo->nombre }} ({{ $equipo->tipo }})
                            </option>
                        @endforeach
                    </select>
                    @error('equipo_id')
                        <small style="color: #ff6b6b;">{{ $message }}</small>
                    @enderror
                </div>
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 20px;">
                <div>
                    <label for="fecha_prestamo" style="color: #ddd; font-weight: 600; margin-bottom: 8px; display: block;">Fecha de Préstamo <span style="color: #dc3545;">*</span></label>
                    <input type="datetime-local" name="fecha_prestamo" id="fecha_prestamo" class="form-control" style="background: #2a2a2a; border: 1px solid #444; color: #fff; padding: 10px; border-radius: 8px;" value="{{ old('fecha_prestamo', now()->format('Y-m-d\TH:i')) }}" required>
                    @error('fecha_prestamo')
                        <small style="color: #ff6b6b;">{{ $message }}</small>
                    @enderror
                </div>

                <div>
                    <label for="fecha_devolucion_estimada" style="color: #ddd; font-weight: 600; margin-bottom: 8px; display: block;">Fecha Estimada de Devolución <span style="color: #dc3545;">*</span></label>
                    <input type="datetime-local" name="fecha_devolucion_estimada" id="fecha_devolucion_estimada" class="form-control" style="background: #2a2a2a; border: 1px solid #444; color: #fff; padding: 10px; border-radius: 8px;" value="{{ old('fecha_devolucion_estimada') }}" required>
                    @error('fecha_devolucion_estimada')
                        <small style="color: #ff6b6b;">{{ $message }}</small>
                    @enderror
                </div>
            </div>

            <div style="display: flex; gap: 10px; justify-content: flex-end;">
                <a href="{{ route('prestamos.index') }}" class="btn-primary-custom" style="background: #6c757d; text-decoration: none;">
                    <i class="fas fa-times"></i> Cancelar
                </a>
                <button type="submit" class="btn-primary-custom">
                    <i class="fas fa-save"></i> Registrar Préstamo
                </button>
            </div>
        </form>
    </div>

    <style>
    .form-control {
        transition: all 0.3s ease;
    }

    .form-control:focus {
        background: #2a2a2a !important;
        border-color: #0d6efd !important;
        box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.25);
        color: #fff;
    }

    .form-control::placeholder {
        color: #666;
    }

    .alert-danger {
        background: #3a1a1a;
        border: 1px solid #8b3a3a;
        color: #ff6b6b;
    }

    .alert-danger strong {
        color: #ff6b6b;
    }

    .alert-danger ul {
        list-style-position: inside;
    }
    </style>
@endsection
