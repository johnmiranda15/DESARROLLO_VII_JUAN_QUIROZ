<?php
require_once 'Empleado.php';
require_once 'Evaluable.php';

class Gerente extends Empleado implements Evaluable {
    private $departamento;
    private $bono;
    
    public function __construct($nombre, $idEmpleado, $salarioBase, $departamento) {
        parent::__construct($nombre, $idEmpleado, $salarioBase);
        $this->departamento = $departamento;
        $this->bono = 0;
    }
    
    public function getDepartamento() {
        return $this->departamento;
    }
    
    public function setDepartamento($departamento) {
        $this->departamento = $departamento;
    }
    
    public function getBono() {
        return $this->bono;
    }
    
    public function asignarBono($monto) {
        $this->bono = $monto;
        echo "Bono de $" . number_format($monto, 2) . " asignado a {$this->nombre}\n";
    }
    
    public function evaluarDesempenio() {
        $puntuacion = rand(7, 10);
        $evaluacion = "";
        
        if ($puntuacion >= 9) {
            $evaluacion = "Excelente";
            $this->asignarBono($this->salarioBase * 0.15);
        } elseif ($puntuacion >= 8) {
            $evaluacion = "Muy Bueno";
            $this->asignarBono($this->salarioBase * 0.10);
        } else {
            $evaluacion = "Bueno";
            $this->asignarBono($this->salarioBase * 0.05);
        }
        
        return "Gerente {$this->nombre} - Puntuación: {$puntuacion}/10 - Evaluación: {$evaluacion}";
    }
    
    public function obtenerInformacion() {
        return parent::obtenerInformacion() . ", Departamento: {$this->departamento}, Tipo: Gerente";
    }
    
    public function calcularSalarioTotal() {
        return $this->salarioBase + $this->bono;
    }
}
?>