@extends('layouts.main')

@section('title', 'Préstamos - Sistema de Préstamos')

@section('content')
    <div class="page-header">
        <h1><i class="fas fa-exchange-alt"></i> Gestión de Préstamos</h1>
        <p>Administra los préstamos de equipos a alumnos.</p>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Error:</strong>
            <ul style="margin: 0;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="section">
        <div class="section-title">
            <i class="fas fa-list"></i>
            Listado de Préstamos
        </div>
        <div style="margin-bottom: 20px;">
            <a href="{{ route('prestamos.create') }}" class="btn-primary-custom"><i class="fas fa-plus"></i> Registrar Nuevo Préstamo</a>
        </div>
        <div style="overflow-x: auto;">
            <table class="table table-dark">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Equipo</th>
                        <th>Alumno (Matrícula)</th>
                        <th>Fecha Préstamo</th>
                        <th>Fecha Est. Devolución</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($prestamos as $prestamo)
                        <tr>
                            <td>#{{ $prestamo->id }}</td>
                            <td><i class="fas fa-laptop"></i> {{ $prestamo->equipo_nombre }}</td>
                            <td>{{ $prestamo->alumno_nombre }} ({{ $prestamo->matricula }})</td>
                            <td>{{ \Carbon\Carbon::parse($prestamo->fecha_prestamo)->format('d/m/Y H:i') }}</td>
                            <td>
                                @if($prestamo->fecha_devolucion)
                                    {{ \Carbon\Carbon::parse($prestamo->fecha_devolucion)->format('d/m/Y H:i') }}
                                @else
                                    <span style="color: #aaa;">Pendiente</span>
                                @endif
                            </td>
                            <td>
                                @if ($prestamo->estado == 'Prestado')
                                    <span class="badge" style="background: #0d6efd;">{{ $prestamo->estado }}</span>
                                @elseif ($prestamo->estado == 'Devuelto')
                                    <span class="badge badge-success">{{ $prestamo->estado }}</span>
                                @else
                                    <span class="badge badge-warning">{{ $prestamo->estado }}</span>
                                @endif
                            </td>
                            <td style="display: flex; gap: 8px;">
                                @if ($prestamo->estado == 'Prestado')
                                    <form action="{{ route('prestamos.devolver', $prestamo->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        <button type="submit" class="btn-primary-custom" style="background: #198754; font-size: 12px; padding: 8px 12px;" onclick="return confirm('¿Confirmar devolución?');"><i class="fas fa-undo"></i> Devolver</button>
                                    </form>
                                    <a href="{{ route('prestamos.edit', $prestamo->id) }}" class="btn-primary-custom" style="font-size: 12px; padding: 8px 12px;"><i class="fas fa-edit"></i> Editar</a>
                                    <form action="{{ route('prestamos.destroy', $prestamo->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-primary-custom" style="background: #dc3545; font-size: 12px; padding: 8px 12px;" onclick="return confirm('¿Eliminar este préstamo?');"><i class="fas fa-trash"></i> Eliminar</button>
                                    </form>
                                @else
                                    <button class="btn-primary-custom" style="background: #6c757d; cursor: not-allowed; font-size: 12px; padding: 8px 12px;" disabled><i class="fas fa-check"></i> Devuelto</button>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" style="text-align: center; color: #666; padding: 20px;">No hay préstamos registrados.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
