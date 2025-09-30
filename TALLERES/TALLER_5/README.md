# Sistema de Gestión de Estudiantes

Sistema simple para gestionar información de estudiantes desarrollado en PHP.

## Funcionalidades

### Clase Estudiante

- Gestión de información personal (ID, nombre, edad, carrera)
- Registro de materias y calificaciones
- Cálculo de promedio individual
- Sistema de flags académicos (Honor Roll, En Riesgo, etc.)

### Clase SistemaGestionEstudiantes

- Agregar y listar estudiantes
- Búsqueda por nombre o carrera
- Cálculo de promedios generales
- Filtrado por carrera
- Ranking de estudiantes
- Reportes de rendimiento
- Graduación de estudiantes
- Estadísticas por carrera

## Uso Básico

```php
// Crear sistema
$sistema = new SistemaGestionEstudiantes();

// Crear estudiante
$estudiante = new Estudiante(1, "Nombre", 20, "Carrera");

// Agregar materias
$estudiante->agregarMateria("Matemáticas", 85);

// Agregar al sistema
$sistema->agregarEstudiante($estudiante);

// Obtener lista
$sistema->listarEstudiantes();
