@extends('layouts.main')

@section('title', 'Equipos - Sistema de Préstamos')

@section('content')
    <div class="page-header">
        <h1>Gestión de Equipos</h1>
        <p>Administra los equipos disponibles para préstamo.</p>
    </div>

    <div class="section">
        <div class="section-title">
            <i class="fas fa-laptop"></i>
            Listado de Equipos
        </div>
        <div class="mb-3">
            <a href="{{ route('equipos.create') }}" class="btn-primary-custom"><i class="fas fa-plus"></i> Añadir Nuevo Equipo</a>
        </div>
        <div class="table-responsive">
            <table class="table table-dark table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Tipo</th>
                        <th>Marca</th>
                        <th>Modelo</th>
                        <th>Estado</th>
                        <th>Fecha Registro</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($equipos as $equipo)
                        <tr>
                            <td>{{ $equipo->id }}</td>
                            <td>{{ $equipo->nombre }}</td>
                            <td>{{ $equipo->tipo }}</td>
                            <td>{{ $equipo->marca }}</td>
                            <td>{{ $equipo->modelo }}</td>
                            <td>
                                @if ($equipo->estado == 'Disponible')
                                    <span class="badge bg-success">{{ $equipo->estado }}</span>
                                @elseif ($equipo->estado == 'Prestado')
                                    <span class="badge bg-warning text-dark">{{ $equipo->estado }}</span>
                                @else
                                    <span class="badge bg-danger">{{ $equipo->estado }}</span>
                                @endif
                            </td>
                            <td>{{ \Carbon\Carbon::parse($equipo->fecha_registro)->format('d/m/Y') }}</td>
                            <td>
                                <a href="{{ route('equipos.edit', $equipo->id) }}" class="btn btn-sm btn-info text-white"><i class="fas fa-edit"></i> Editar</a>
                                <form action="{{ route('equipos.destroy', $equipo->id) }}" method="POST" style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('¿Estás seguro de eliminar este equipo?');"><i class="fas fa-trash"></i> Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center">No hay equipos registrados.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
