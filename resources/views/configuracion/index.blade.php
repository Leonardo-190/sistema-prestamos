@extends('layouts.main')

@section('title', 'Configuración - Sistema de Préstamos')

@section('content')
    <div class="page-header">
        <h1><i class="fas fa-cog"></i> Configuración del Sistema</h1>
        <p>Ajusta las opciones generales y perfil de usuario</p>
    </div>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert" style="background: #1a3a1a; border: 1px solid #3a8b3a; color: #51cf66;">
            {{ session('success') }}
        </div>
    @endif

    <!-- Perfil de Usuario -->
    <div class="section">
        <div class="section-title">
            <i class="fas fa-user"></i>
            Perfil de Usuario
        </div>

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 30px;">
            <div>
                <label style="color: #aaa; font-size: 13px; text-transform: uppercase; display: block; margin-bottom: 10px;">Nombre de Usuario</label>
                <p style="color: #fff; font-size: 16px; padding: 12px; background: #2a2a2a; border-radius: 8px;">{{ $user->name }}</p>
            </div>

            <div>
                <label style="color: #aaa; font-size: 13px; text-transform: uppercase; display: block; margin-bottom: 10px;">Correo Electrónico</label>
                <p style="color: #fff; font-size: 16px; padding: 12px; background: #2a2a2a; border-radius: 8px;">{{ $user->email }}</p>
            </div>
        </div>

        <a href="{{ route('profile.edit') }}" class="btn-primary-custom">
            <i class="fas fa-edit"></i> Editar Perfil
        </a>
    </div>

    <!-- Información del Sistema -->
    <div class="section">
        <div class="section-title">
            <i class="fas fa-info-circle"></i>
            Información del Sistema
        </div>

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
            <div>
                <label style="color: #aaa; font-size: 13px; text-transform: uppercase; display: block; margin-bottom: 10px;">Nombre del Sistema</label>
                <p style="color: #fff; font-size: 16px; padding: 12px; background: #2a2a2a; border-radius: 8px;">Sistema de Préstamos UPQ</p>
            </div>

            <div>
                <label style="color: #aaa; font-size: 13px; text-transform: uppercase; display: block; margin-bottom: 10px;">Versión</label>
                <p style="color: #fff; font-size: 16px; padding: 12px; background: #2a2a2a; border-radius: 8px;">1.0.0</p>
            </div>

            <div>
                <label style="color: #aaa; font-size: 13px; text-transform: uppercase; display: block; margin-bottom: 10px;">Última Actualización</label>
                <p style="color: #fff; font-size: 16px; padding: 12px; background: #2a2a2a; border-radius: 8px;">04/05/2026</p>
            </div>

            <div>
                <label style="color: #aaa; font-size: 13px; text-transform: uppercase; display: block; margin-bottom: 10px;">Estado</label>
                <p style="color: #51cf66; font-size: 16px; padding: 12px; background: #2a2a2a; border-radius: 8px;"><i class="fas fa-check-circle"></i> Operativo</p>
            </div>
        </div>
    </div>

@endsection
