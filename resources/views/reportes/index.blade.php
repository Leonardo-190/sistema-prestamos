@extends('layouts.main')

@section('title', 'Reportes - Sistema de Préstamos')

@section('content')
    <div class="page-header">
        <h1><i class="fas fa-chart-bar"></i> Reportes y Estadísticas</h1>
        <p>Análisis completo del sistema de préstamos y equipos</p>
    </div>

    <!-- Estadísticas Principales -->
    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-icon blue">
                <i class="fas fa-laptop"></i>
            </div>
            <div class="stat-number">{{ $equipos_total }}</div>
            <div class="stat-label">Equipos Totales</div>
        </div>

        <div class="stat-card">
            <div class="stat-icon green">
                <i class="fas fa-check-circle"></i>
            </div>
            <div class="stat-number">{{ $equipos_disponibles }}</div>
            <div class="stat-label">Disponibles</div>
        </div>

        <div class="stat-card">
            <div class="stat-icon orange">
                <i class="fas fa-exchange-alt"></i>
            </div>
            <div class="stat-number">{{ $equipos_prestados }}</div>
            <div class="stat-label">En Préstamo</div>
        </div>

        <div class="stat-card">
            <div class="stat-icon purple">
                <i class="fas fa-tools"></i>
            </div>
            <div class="stat-number">{{ $equipos_danados }}</div>
            <div class="stat-label">Dañados</div>
        </div>
    </div>

    <!-- Estadísticas de Préstamos -->
    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-icon blue">
                <i class="fas fa-boxes"></i>
            </div>
            <div class="stat-number">{{ $prestamos_total }}</div>
            <div class="stat-label">Préstamos Totales</div>
        </div>

        <div class="stat-card">
            <div class="stat-icon green">
                <i class="fas fa-hourglass-start"></i>
            </div>
            <div class="stat-number">{{ $prestamos_activos }}</div>
            <div class="stat-label">Activos</div>
        </div>

        <div class="stat-card">
            <div class="stat-icon orange">
                <i class="fas fa-check"></i>
            </div>
            <div class="stat-number">{{ $prestamos_devueltos }}</div>
            <div class="stat-label">Devueltos</div>
        </div>

        <div class="stat-card">
            <div class="stat-icon purple">
                <i class="fas fa-exclamation-triangle"></i>
            </div>
            <div class="stat-number">{{ $prestamos_retrasados }}</div>
            <div class="stat-label">Retrasados</div>
        </div>
    </div>

    <!-- Inventario por Tipo -->
    <div class="section">
        <div class="section-title">
            <i class="fas fa-cubes"></i>
            Inventario por Tipo de Equipo
        </div>
        <table class="table table-dark">
            <thead>
                <tr>
                    <th>Tipo de Equipo</th>
                    <th>Total</th>
                    <th>Disponibles</th>
                    <th>En Préstamo</th>
                    <th>Dañados</th>
                </tr>
            </thead>
            <tbody>
                @forelse($inventarioEquipos as $inv)
                <tr>
                    <td><strong>{{ $inv->tipo }}</strong></td>
                    <td>{{ $inv->cantidad }}</td>
                    <td style="color: #51cf66;">{{ $inv->disponibles }}</td>
                    <td>{{ $inv->cantidad - $inv->disponibles - DB::table('equipos')->where('tipo', $inv->tipo)->where('estado', 'Dañado')->count() }}</td>
                    <td>{{ DB::table('equipos')->where('tipo', $inv->tipo)->where('estado', 'Dañado')->count() }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" style="text-align: center; color: #666;">No hay equipos registrados</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Historial de Préstamos -->
    <div class="section">
        <div class="section-title">
            <i class="fas fa-history"></i>
            Historial Completo de Préstamos
        </div>
        <div style="overflow-x: auto;">
            <table class="table table-dark">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Equipo</th>
                        <th>Alumno (Matrícula)</th>
                        <th>Fecha Préstamo</th>
                        <th>Fecha Devolución</th>
                        <th>Estado</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($historialPrestamos as $prestamo)
                    <tr>
                        <td>#{{ $prestamo->id }}</td>
                        <td>{{ $prestamo->equipo_nombre }}</td>
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
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" style="text-align: center; color: #666;">No hay préstamos registrados</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Botones de Descarga -->
    <div class="section">
        <div class="section-title">
            <i class="fas fa-download"></i>
            Exportar Reportes
        </div>
        <div style="display: flex; gap: 10px;">
            <a href="#" class="btn-primary-custom" style="background: #dc3545;">
                <i class="fas fa-file-pdf"></i> Descargar PDF
            </a>
            <a href="#" class="btn-primary-custom" style="background: #28a745;">
                <i class="fas fa-file-excel"></i> Descargar Excel
            </a>
            <a href="javascript:window.print()" class="btn-primary-custom" style="background: #6c757d;">
                <i class="fas fa-print"></i> Imprimir
            </a>
        </div>
    </div>
@endsection
