# Instrucciones para Correr el Sistema

## 1. Actualizar la base de datos

Ejecuta los siguientes comandos en la terminal (PowerShell o cmd):

```bash
cd C:\laragon\www\sistema-prestamos

# Ejecutar migraciones y seeders (esto creará tablas y datos de prueba)
php artisan migrate:fresh --seed
```

## 2. Iniciar el servidor Laravel

```bash
php artisan serve
```

El servidor estará disponible en: `http://localhost:8000`

## 3. Credenciales de Prueba

Después de ejecutar las migraciones, usa estas credenciales para entrar:

### Usuario 1 (Administrador)
- **Email:** `admin@upq.edu.mx`
- **Contraseña:** `admin123`

### Usuario 2 (Usuario Común)
- **Email:** `usuario@upq.edu.mx`
- **Contraseña:** `usuario123`

**Nota:** Las credenciales se crean automáticamente al ejecutar `php artisan migrate:fresh --seed`

## 4. Características Implementadas

✅ **Autenticación:** Login funcional con validación  
✅ **Dashboard:** Contadores dinámicos con datos reales de la BD  
✅ **Gráficas Google Charts:** Distribución de equipos y préstamos  
✅ **Equipos:** CRUD completo (Crear, Leer, Editar, Eliminar)  
✅ **Alumnos:** CRUD completo con validaciones de matrícula única  
✅ **Préstamos:** CRUD + Botón de devolución (funcionalidad crítica)  
✅ **Reportes:** Dashboard con estadísticas e historial  
✅ **Configuración:** Perfil de usuario  
✅ **Diseño:** Minimalista oscuro, responsive y consistente  

## 5. Rutas Principales

- `/login` - Página de login
- `/dashboard` - Panel principal con estadísticas
- `/equipos` - Gestión de inventario
- `/alumnos` - Padrón de estudiantes
- `/prestamos` - Registro y seguimiento de préstamos
- `/reportes` - Reportes y estadísticas
- `/configuracion` - Configuración del sistema
- `/profile` - Perfil de usuario

## 6. Funcionalidades Críticas Implementadas

### ✅ Botón de Devolución
Al presionar "Devolver" en un préstamo activo:
1. ✅ Actualiza la `fecha_devolucion` a la fecha actual
2. ✅ Cambia el estado del préstamo a "Devuelto"
3. ✅ Cambia el estado del equipo a "Disponible"

### ✅ Crear Préstamo
Al registrar un nuevo préstamo:
1. ✅ Valida que el alumno exista
2. ✅ Verifica que el equipo esté "Disponible"
3. ✅ Cambia automáticamente el estado del equipo a "Prestado"
4. ✅ Registra la fecha y hora del préstamo

### ✅ Validaciones
- Matrículas únicas de alumnos
- Correos válidos con formato de email
- Equipos no pueden ser prestados si no están disponibles
- Validación de fechas (devolución posterior a préstamo)

## 7. Datos de Prueba

Se incluyen automáticamente:
- **6 Equipos:** Laptops, Monitor, Proyector, Periféricos
- **4 Alumnos:** Con diferentes carreras
- **3 Préstamos históricos:** Algunos activos, algunos devueltos

## 8. Solución de Problemas

### El servidor no corre
```bash
# Opción 1: Usar php artisan serve
php artisan serve

# Opción 2: Limpiar cache
php artisan config:cache
php artisan cache:clear

# Opción 3: Verificar PHP está en el sistema
php -v
```

### Errores en migraciones
```bash
# Resetear la base de datos completamente
php artisan migrate:fresh --seed

# O si hay problemas
php artisan migrate:reset
php artisan migrate:fresh --seed
```

### Login no funciona
1. Verifica que la tabla `users` exista: `php artisan migrate`
2. Verifica que los seeders se ejecutaron: `php artisan db:seed`
3. Borra el cache: `php artisan cache:clear`

## 9. Estructura de la Base de Datos

```
users
├── id
├── name
├── email
└── password

equipos
├── id
├── nombre
├── tipo (Laptop, Proyector, etc)
├── marca
├── modelo
├── numero_serie
├── estado (Disponible, Prestado, Dañado)
└── fecha_registro

alumnos
├── id
├── matricula (única)
├── nombre
├── apellido_paterno
├── apellido_materno
├── carrera
├── correo (única)
└── telefono

prestamos
├── id
├── equipo_id (FK)
├── alumno_id (FK)
├── fecha_prestamo
├── fecha_devolucion
└── estado (Prestado, Devuelto, Retrasado)
```

¡Sistema listo para usar! 🚀

