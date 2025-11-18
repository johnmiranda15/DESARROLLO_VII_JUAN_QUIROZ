# Sistema de Calificaciones

Sistema simple de visualización de calificaciones con dos roles: Profesor y Estudiante.

## Instalación

1. Coloca todos los archivos en la carpeta: `PARCIALES/PARCIAL_3/`
2. Abre tu navegador en: `http://localhost/PARCIALES/PARCIAL_3/login.php`

## Usuarios de Prueba

### Profesor

- Usuario: `profesor`
- Contraseña: `profesor123`
- Puede ver: Todos los estudiantes y sus calificaciones

### Estudiantes

### Estudiante 1

- Usuario: `estudiante1`
- Contraseña: `estudiante123`
- Nombre: Juan Quiroz

### Estudiante 2

- Usuario: `estudiante2`
- Contraseña: `estudiante456`
- Nombre: Carlos Vega

### Estudiante 3

- Usuario: `estudiante3`
- Contraseña: `estudiante789`
- Nombre: Victor Lopez

## Uso

1. Ingresa con cualquier usuario de prueba
2. El profesor verá todos los estudiantes
3. Cada estudiante verá solo sus propias calificaciones
4. Click en "Cerrar Sesión" para salir

## Archivos

- `login.php` - Página de inicio
- `autenticar.php` - Valida credenciales
- `dashboard_profesor.php` - Panel del profesor
- `dashboard_estudiante.php` - Panel del estudiante
- `usuarios.php` - Base de datos de usuarios
- `cerrar_sesion.php` - Cierra sesión
