@extends('layouts.main')

@section('title', 'Dashboard - Sistema de Préstamos')

@section('content')
    <!-- Page Header -->
    <div class="page-header">
        <h1>Bienvenido, {{ Auth::user()->name ?? 'Usuario' }}!</h1>
        <p>Aquí está un resumen de tu sistema de préstamos</p>
    </div>

    <!-- Stats Grid -->
    <div class="stats-grid">
        <div class="stat-card" onclick="window.location.href='{{ route('equipos.index') }}';" style="cursor: pointer;">
            <div class="stat-icon blue">
                <i class="fas fa-laptop"></i>
            </div>
            <div class="stat-number">{{ $equiposDisponibles }}</div>
            <div class="stat-label">Equipos Disponibles</div>
        </div>

        <div class="stat-card" onclick="window.location.href='{{ route('prestamos.index') }}';" style="cursor: pointer;">
            <div class="stat-icon green">
                <i class="fas fa-check-circle"></i>
            </div>
            <div class="stat-number">{{ $prestamosActivos }}</div>
            <div class="stat-label">Préstamos Activos</div>
        </div>

        <div class="stat-card" onclick="window.location.href='{{ route('alumnos.index') }}';" style="cursor: pointer;">
            <div class="stat-icon orange">
                <i class="fas fa-users"></i>
            </div>
            <div class="stat-number">{{ $alumnosTotales }}</div>
            <div class="stat-label">Alumnos Registrados</div>
        </div>

        <div class="stat-card" onclick="window.location.href='{{ route('reportes.index') }}';" style="cursor: pointer;">
            <div class="stat-icon purple">
                <i class="fas fa-exclamation-triangle"></i>
            </div>
            <div class="stat-number">{{ $equiposDanados }}</div>
            <div class="stat-label">Equipos en Mantenimiento</div>
        </div>
    </div>

    <!-- Gráficas -->
    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 40px;">
        <div class="section">
            <div class="section-title">
                <i class="fas fa-pie-chart"></i>
                Equipos por Tipo
            </div>
            <div id="piechart" style="width: 100%; height: 300px;"></div>
        </div>

        <div class="section">
            <div class="section-title">
                <i class="fas fa-bar-chart"></i>
                Préstamos Última Semana
            </div>
            <div id="barchart" style="width: 100%; height: 300px;"></div>
        </div>
    </div>

    <!-- Préstamos Recientes -->
    <div class="section">
        <div class="section-title">
            <i class="fas fa-history"></i>
            Préstamos Recientes
        </div>
        <table class="table table-dark">
            <thead>
                <tr>
                    <th>Equipo</th>
                    <th>Alumno</th>
                    <th>Fecha Préstamo</th>
                    <th>Fecha Devolución</th>
                    <th>Estado</th>
                </tr>
            </thead>
            <tbody>
                @forelse($prestamosRecientes as $prestamo)
                <tr>
                    <td><i class="fas fa-laptop"></i> {{ $prestamo->equipo_nombre }}</td>
                    <td>{{ $prestamo->alumno_nombre }}</td>
                    <td>{{ \Carbon\Carbon::parse($prestamo->fecha_prestamo)->format('d/m/Y H:i') }}</td>
                    <td>
                        @if($prestamo->fecha_devolucion)
                            {{ \Carbon\Carbon::parse($prestamo->fecha_devolucion)->format('d/m/Y H:i') }}
                        @else
                            <span style="color: #aaa;">Pendiente</span>
                        @endif
                    </td>
                    <td>
                        @if($prestamo->estado == 'Prestado')
                            <span class="badge" style="background: #0d6efd;">{{ $prestamo->estado }}</span>
                        @elseif($prestamo->estado == 'Devuelto')
                            <span class="badge badge-success">{{ $prestamo->estado }}</span>
                        @else
                            <span class="badge badge-warning">{{ $prestamo->estado }}</span>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" style="text-align: center; color: #666;">No hay préstamos registrados</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Equipos en Mantenimiento -->
    <div class="section">
        <div class="section-title">
            <i class="fas fa-tools"></i>
            Equipos en Mantenimiento
        </div>
        <table class="table table-dark">
            <thead>
                <tr>
                    <th>Equipo</th>
                    <th>Tipo</th>
                    <th>Marca</th>
                    <th>Modelo</th>
                    <th>Estado</th>
                </tr>
            </thead>
            <tbody>
                @forelse($equiposDanados_list as $equipo)
                <tr>
                    <td><i class="fas fa-monitor"></i> {{ $equipo->nombre }}</td>
                    <td>{{ $equipo->tipo }}</td>
                    <td>{{ $equipo->marca }}</td>
                    <td>{{ $equipo->modelo }}</td>
                    <td><span class="badge" style="background: #6f42c1;">En Reparación</span></td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" style="text-align: center; color: #666;">No hay equipos en mantenimiento</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        google.charts.load('current', {'packages':['corechart']});
        google.charts.setOnLoadCallback(drawCharts);

        function drawCharts() {
            drawPieChart();
            drawBarChart();
        }

        function drawPieChart() {
            var data = google.visualization.arrayToDataTable([
                ['Tipo', 'Cantidad'],
                @foreach($equiposPorTipo as $tipo)
                    ['{{ $tipo->tipo }}', {{ $tipo->cantidad }}],
                @endforeach
            ]);

            var options = {
                title: '',
                pieHole: 0.4,
                backgroundColor: 'transparent',
                titleTextStyle: { color: '#fff' },
                legend: { textStyle: { color: '#aaa' } },
                pieSliceTextStyle: { color: '#fff' },
                colors: ['#0d6efd', '#198754', '#fd7e14', '#6f42c1', '#dc3545']
            };

            var chart = new google.visualization.PieChart(document.getElementById('piechart'));
            chart.draw(data, options);
        }

        function drawBarChart() {
            var data = google.visualization.arrayToDataTable([
                ['Fecha', 'Préstamos',  { role: 'style' } ],
                @foreach($prestamosUltimaSemana as $dato)
                    ['{{ \Carbon\Carbon::parse($dato->fecha)->format('d/m') }}', {{ $dato->cantidad }}, '#0d6efd'],
                @endforeach
            ]);

            var options = {
                title: '',
                backgroundColor: 'transparent',
                titleTextStyle: { color: '#fff' },
                legend: { position: 'none' },
                hAxis: { textStyle: { color: '#aaa' }, gridlines: { color: 'transparent' } },
                vAxis: { textStyle: { color: '#aaa' }, gridlines: { color: '#333' } },
            };

            var chart = new google.visualization.BarChart(document.getElementById('barchart'));
            chart.draw(data, options);
        }
    </script>
@endsection
