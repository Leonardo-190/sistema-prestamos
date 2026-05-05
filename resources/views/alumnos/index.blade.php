@extends('layouts.main')

@section('title', 'Alumnos - Sistema de Préstamos')

@section('content')
    <div class="page-header">
        <h1>Gestión de Alumnos</h1>
        <p>Administra la información de los alumnos registrados.</p>
    </div>

    <div class="section">
        <div class="section-title">
            <i class="fas fa-users"></i>
            Listado de Alumnos
        </div>
        <div class="mb-3">
            <a href="{{ route('alumnos.create') }}" class="btn-primary-custom"><i class="fas fa-user-plus"></i> Registrar Nuevo Alumno</a>
        </div>
        <div class="table-responsive">
            <table class="table table-dark table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Matrícula</th>
                        <th>Nombre</th>
                        <th>Apellidos</th>
                        <th>Carrera</th>
                        <th>Correo</th>
                        <th>Teléfono</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($alumnos as $alumno)
                        <tr>
                            <td>{{ $alumno->id }}</td>
                            <td>{{ $alumno->matricula }}</td>
                            <td>{{ $alumno->nombre }}</td>
                            <td>{{ $alumno->apellido_paterno }} {{ $alumno->apellido_materno }}</td>
                            <td>{{ $alumno->carrera }}</td>
                            <td>{{ $alumno->correo }}</td>
                            <td>{{ $alumno->telefono }}</td>
                            <td>
                                <a href="{{ route('alumnos.edit', $alumno->id) }}" class="btn btn-sm btn-info text-white"><i class="fas fa-edit"></i> Editar</a>
                                <form action="{{ route('alumnos.destroy', $alumno->id) }}" method="POST" style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('¿Estás seguro de eliminar a este alumno?');"><i class="fas fa-trash"></i> Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center">No hay alumnos registrados.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
