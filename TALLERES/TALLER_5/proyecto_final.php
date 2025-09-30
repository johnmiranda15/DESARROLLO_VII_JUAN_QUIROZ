<?php

class Estudiante {
    public $id;
    public $nombre;
    public $edad;
    public $carrera;
    public $materias;
    public $flag;

    public function __construct($id, $nombre, $edad, $carrera) {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->edad = $edad;
        $this->carrera = $carrera;
        $this->materias = [];
        $this->flag = "Normal";
    }

    public function agregarMateria($materia, $calificacion) {
        $this->materias[$materia] = $calificacion;
        $this->actualizarFlag();
    }

    public function obtenerPromedio() {
        if (empty($this->materias)) {
            return 0;
        }
        return array_sum($this->materias) / count($this->materias);
    }

    public function obtenerDetalles() {
        return [
            'id' => $this->id,
            'nombre' => $this->nombre,
            'edad' => $this->edad,
            'carrera' => $this->carrera,
            'materias' => $this->materias,
            'promedio' => $this->obtenerPromedio(),
            'flag' => $this->flag
        ];
    }

    private function actualizarFlag() {
        $promedio = $this->obtenerPromedio();
        $reprobadas = count(array_filter($this->materias, function($calif) {
            return $calif < 60;
        }));

        if ($promedio >= 90) {
            $this->flag = "Honor Roll";
        } elseif ($reprobadas >= 3) {
            $this->flag = "En Riesgo Academico";
        } elseif ($promedio < 70) {
            $this->flag = "Necesita Mejorar";
        } else {
            $this->flag = "Normal";
        }
    }

    public function __toString() {
        return "ID: {$this->id} | {$this->nombre} | {$this->carrera} | Promedio: " . round($this->obtenerPromedio(), 2);
    }
}

class SistemaGestionEstudiantes {
    private $estudiantes;
    private $graduados;

    public function __construct() {
        $this->estudiantes = [];
        $this->graduados = [];
    }

    public function agregarEstudiante(Estudiante $estudiante) {
        $this->estudiantes[$estudiante->id] = $estudiante;
    }

    public function obtenerEstudiante($id) {
        return $this->estudiantes[$id] ?? null;
    }

    public function listarEstudiantes() {
        return $this->estudiantes;
    }

    public function calcularPromedioGeneral() {
        if (empty($this->estudiantes)) {
            return 0;
        }
        
        $promedios = array_map(function($estudiante) {
            return $estudiante->obtenerPromedio();
        }, $this->estudiantes);
        
        return array_sum($promedios) / count($promedios);
    }

    public function obtenerEstudiantesPorCarrera($carrera) {
        return array_filter($this->estudiantes, function($estudiante) use ($carrera) {
            return strtolower($estudiante->carrera) === strtolower($carrera);
        });
    }

    public function obtenerMejorEstudiante() {
        if (empty($this->estudiantes)) {
            return null;
        }
        
        $mejor = null;
        foreach ($this->estudiantes as $estudiante) {
            if ($mejor === null || $estudiante->obtenerPromedio() > $mejor->obtenerPromedio()) {
                $mejor = $estudiante;
            }
        }
        return $mejor;
    }

    public function generarReporteRendimiento() {
        $reporte = [];
        
        $todasMaterias = [];
        foreach ($this->estudiantes as $estudiante) {
            foreach ($estudiante->materias as $materia => $calificacion) {
                $todasMaterias[$materia][] = $calificacion;
            }
        }
        
        foreach ($todasMaterias as $materia => $calificaciones) {
            $reporte[$materia] = [
                'promedio' => array_sum($calificaciones) / count($calificaciones),
                'maxima' => max($calificaciones),
                'minima' => min($calificaciones)
            ];
        }
        
        return $reporte;
    }

    public function graduarEstudiante($id) {
        if (isset($this->estudiantes[$id])) {
            $estudiante = $this->estudiantes[$id];
            $this->graduados[$id] = $estudiante;
            unset($this->estudiantes[$id]);
            return true;
        }
        return false;
    }

    public function generarRanking() {
        $estudiantesArray = $this->estudiantes;
        
        usort($estudiantesArray, function($a, $b) {
            return $b->obtenerPromedio() <=> $a->obtenerPromedio();
        });
        
        return $estudiantesArray;
    }

    public function buscarEstudiantes($termino) {
        return array_filter($this->estudiantes, function($estudiante) use ($termino) {
            $termino = strtolower($termino);
            return strpos(strtolower($estudiante->nombre), $termino) !== false || 
                   strpos(strtolower($estudiante->carrera), $termino) !== false;
        });
    }

    public function generarEstadisticasCarreras() {
        $estadisticas = [];
        $carreras = array_unique(array_map(function($est) {
            return $est->carrera;
        }, $this->estudiantes));
        
        foreach ($carreras as $carrera) {
            $estudiantesCarrera = $this->obtenerEstudiantesPorCarrera($carrera);
            $promedios = array_map(function($est) {
                return $est->obtenerPromedio();
            }, $estudiantesCarrera);
            
            $mejor = null;
            foreach ($estudiantesCarrera as $est) {
                if ($mejor === null || $est->obtenerPromedio() > $mejor->obtenerPromedio()) {
                    $mejor = $est;
                }
            }
            
            $estadisticas[$carrera] = [
                'cantidad' => count($estudiantesCarrera),
                'promedio' => empty($promedios) ? 0 : array_sum($promedios) / count($promedios),
                'mejor_estudiante' => $mejor ? $mejor->nombre : 'N/A'
            ];
        }
        
        return $estadisticas;
    }
}

echo "<h1>Sistema de Gestion de Estudiantes</h1>";
echo "<pre>";

$sistema = new SistemaGestionEstudiantes();

$estudiantes = [
    new Estudiante(1, "Juan Perez", 20, "Ingenieria"),
    new Estudiante(2, "Maria Garcia", 22, "Medicina"),
    new Estudiante(3, "Carlos Lopez", 21, "Ingenieria"),
    new Estudiante(4, "Ana Martinez", 23, "Derecho"),
    new Estudiante(5, "Pedro Rodriguez", 20, "Medicina"),
    new Estudiante(6, "Laura Hernandez", 22, "Administracion"),
    new Estudiante(7, "Miguel Torres", 21, "Ingenieria"),
    new Estudiante(8, "Sofia Ramirez", 23, "Derecho"),
    new Estudiante(9, "Diego Silva", 20, "Administracion"),
    new Estudiante(10, "Elena Castro", 22, "Medicina")
];

foreach ($estudiantes as $estudiante) {
    $sistema->agregarEstudiante($estudiante);
}

$estudiantes[0]->agregarMateria("Matematicas", 95);
$estudiantes[0]->agregarMateria("Fisica", 88);
$estudiantes[0]->agregarMateria("Programacion", 92);

$estudiantes[1]->agregarMateria("Anatomia", 78);
$estudiantes[1]->agregarMateria("Biologia", 85);
$estudiantes[1]->agregarMateria("Quimica", 82);

$estudiantes[2]->agregarMateria("Matematicas", 65);
$estudiantes[2]->agregarMateria("Fisica", 58);
$estudiantes[2]->agregarMateria("Programacion", 72);

$estudiantes[3]->agregarMateria("Derecho Civil", 88);
$estudiantes[3]->agregarMateria("Derecho Penal", 92);
$estudiantes[3]->agregarMateria("Constitucion", 85);

$estudiantes[4]->agregarMateria("Anatomia", 90);
$estudiantes[4]->agregarMateria("Biologia", 88);
$estudiantes[4]->agregarMateria("Quimica", 91);

$estudiantes[5]->agregarMateria("Contabilidad", 75);
$estudiantes[5]->agregarMateria("Marketing", 80);
$estudiantes[5]->agregarMateria("Finanzas", 78);

$estudiantes[6]->agregarMateria("Matematicas", 70);
$estudiantes[6]->agregarMateria("Fisica", 68);
$estudiantes[6]->agregarMateria("Programacion", 75);

$estudiantes[7]->agregarMateria("Derecho Civil", 82);
$estudiantes[7]->agregarMateria("Derecho Penal", 79);
$estudiantes[7]->agregarMateria("Constitucion", 84);

$estudiantes[8]->agregarMateria("Contabilidad", 85);
$estudiantes[8]->agregarMateria("Marketing", 88);
$estudiantes[8]->agregarMateria("Finanzas", 86);

$estudiantes[9]->agregarMateria("Anatomia", 92);
$estudiantes[9]->agregarMateria("Biologia", 94);
$estudiantes[9]->agregarMateria("Quimica", 90);

echo "\n=== SISTEMA DE GESTION DE ESTUDIANTES ===\n\n";

echo "1. LISTA DE ESTUDIANTES:\n";
foreach ($sistema->listarEstudiantes() as $estudiante) {
    echo "- " . $estudiante . " | Flag: {$estudiante->flag}\n";
}

echo "\n2. PROMEDIO GENERAL DEL SISTEMA:\n";
echo "Promedio: " . round($sistema->calcularPromedioGeneral(), 2) . "\n";

echo "\n3. MEJOR ESTUDIANTE:\n";
$mejor = $sistema->obtenerMejorEstudiante();
if ($mejor) {
    echo $mejor . " | Flag: {$mejor->flag}\n";
}

echo "\n4. ESTUDIANTES DE INGENIERIA:\n";
$ingenieria = $sistema->obtenerEstudiantesPorCarrera("Ingenieria");
foreach ($ingenieria as $est) {
    echo "- " . $est . " | Flag: {$est->flag}\n";
}

echo "\n5. BUSQUEDA POR 'MAR':\n";
$busqueda = $sistema->buscarEstudiantes("mar");
foreach ($busqueda as $est) {
    echo "- " . $est . "\n";
}

echo "\n6. RANKING DE ESTUDIANTES:\n";
$ranking = $sistema->generarRanking();
foreach ($ranking as $index => $est) {
    echo ($index + 1) . ". " . $est . " | Flag: {$est->flag}\n";
}

echo "\n7. ESTADISTICAS POR CARRERA:\n";
$estadisticas = $sistema->generarEstadisticasCarreras();
foreach ($estadisticas as $carrera => $datos) {
    echo "{$carrera}:\n";
    echo "  Cantidad: {$datos['cantidad']} estudiantes\n";
    echo "  Promedio: " . round($datos['promedio'], 2) . "\n";
    echo "  Mejor estudiante: {$datos['mejor_estudiante']}\n\n";
}

echo "\n8. GRADUAR ESTUDIANTE (ID 1):\n";
if ($sistema->graduarEstudiante(1)) {
    echo "Estudiante Juan Perez graduado exitosamente\n";
    echo "Total de estudiantes activos: " . count($sistema->listarEstudiantes()) . "\n";
}

echo "\n9. REPORTE DE RENDIMIENTO POR MATERIA:\n";
$reporte = $sistema->generarReporteRendimiento();
foreach ($reporte as $materia => $datos) {
    echo "{$materia}:\n";
    echo "  Promedio: " . round($datos['promedio'], 2) . "\n";
    echo "  Calificacion maxima: {$datos['maxima']}\n";
    echo "  Calificacion minima: {$datos['minima']}\n\n";
}

echo "\n10. DETALLES COMPLETOS DE ESTUDIANTE (ID 2):\n";
$est = $sistema->obtenerEstudiante(2);
if ($est) {
    $detalles = $est->obtenerDetalles();
    echo "ID: {$detalles['id']}\n";
    echo "Nombre: {$detalles['nombre']}\n";
    echo "Edad: {$detalles['edad']} años\n";
    echo "Carrera: {$detalles['carrera']}\n";
    echo "Promedio: " . round($detalles['promedio'], 2) . "\n";
    echo "Flag: {$detalles['flag']}\n";
    echo "Materias:\n";
    foreach ($detalles['materias'] as $materia => $calificacion) {
        echo "  - {$materia}: {$calificacion}\n";
    }
}

echo "\n";
echo "</pre>";
echo "<p><strong>Sistema de gestion de estudiantes completado!</strong></p>";
?>