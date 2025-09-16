<?php
require_once 'Empleado.php';
require_once 'Evaluable.php';

class Empresa {
    private $empleados = [];
    private $nombre;
    
    public function __construct($nombre) {
        $this->nombre = $nombre;
    }
    
    public function agregarEmpleado(Empleado $empleado) {
        $this->empleados[] = $empleado;
        echo "Empleado {$empleado->getNombre()} agregado a {$this->nombre}\n";
    }
    
    public function listarEmpleados() {
        echo "\n=== LISTADO DE EMPLEADOS - {$this->nombre} ===\n";
        foreach ($this->empleados as $empleado) {
            echo "- " . $empleado->obtenerInformacion() . "\n";
        }
        echo "\n";
    }
    
    public function calcularNominaTotal() {
        $total = 0;
        foreach ($this->empleados as $empleado) {
            if (method_exists($empleado, 'calcularSalarioTotal')) {
                $total += $empleado->calcularSalarioTotal();
            } else {
                $total += $empleado->getSalarioBase();
            }
        }
        return $total;
    }
    
    public function evaluarTodos() {
        echo "\n=== EVALUACIONES DE DESEMPEÑO ===\n";
        foreach ($this->empleados as $empleado) {
            if ($empleado instanceof Evaluable) {
                echo "- " . $empleado->evaluarDesempenio() . "\n";
            } else {
                echo "- {$empleado->getNombre()}: No evaluable\n";
            }
        }
        echo "\n";
    }
    
    public function getTotalEmpleados() {
        return count($this->empleados);
    }
}
?>