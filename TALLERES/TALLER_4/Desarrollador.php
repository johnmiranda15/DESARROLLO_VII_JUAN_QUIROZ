<?php
require_once 'Empleado.php';
require_once 'Evaluable.php';

class Desarrollador extends Empleado implements Evaluable {
    private $lenguajePrincipal;
    private $nivelExperiencia;
    private $aumentoSalarial;
    
    public function __construct($nombre, $idEmpleado, $salarioBase, $lenguajePrincipal, $nivelExperiencia) {
        parent::__construct($nombre, $idEmpleado, $salarioBase);
        $this->lenguajePrincipal = $lenguajePrincipal;
        $this->nivelExperiencia = $nivelExperiencia;
        $this->aumentoSalarial = 0;
    }
    
    public function getLenguajePrincipal() {
        return $this->lenguajePrincipal;
    }
    
    public function setLenguajePrincipal($lenguajePrincipal) {
        $this->lenguajePrincipal = $lenguajePrincipal;
    }
    
    public function getNivelExperiencia() {
        return $this->nivelExperiencia;
    }
    
    public function setNivelExperiencia($nivelExperiencia) {
        $this->nivelExperiencia = $nivelExperiencia;
    }
    
    public function getAumentoSalarial() {
        return $this->aumentoSalarial;
    }
    
    public function evaluarDesempenio() {
        $puntuacion = rand(6, 10);
        $evaluacion = "";
        
        if ($this->nivelExperiencia == "Senior") {
            $puntuacion += 1;
        } elseif ($this->nivelExperiencia == "Semi-Senior") {
            $puntuacion += 0.5;
        }
        
        $puntuacion = min($puntuacion, 10);
        
        if ($puntuacion >= 9) {
            $evaluacion = "Excelente";
            $this->aumentoSalarial = $this->salarioBase * 0.12;
        } elseif ($puntuacion >= 8) {
            $evaluacion = "Muy Bueno";
            $this->aumentoSalarial = $this->salarioBase * 0.08;
        } elseif ($puntuacion >= 7) {
            $evaluacion = "Bueno";
            $this->aumentoSalarial = $this->salarioBase * 0.05;
        } else {
            $evaluacion = "Regular";
            $this->aumentoSalarial = 0;
        }
        
        if ($this->aumentoSalarial > 0) {
            echo "Aumento salarial de $" . number_format($this->aumentoSalarial, 2) . " para {$this->nombre}\n";
        }
        
        return "Desarrollador {$this->nombre} - Puntuación: " . number_format($puntuacion, 1) . "/10 - Evaluación: {$evaluacion}";
    }
    
    public function obtenerInformacion() {
        return parent::obtenerInformacion() . ", Lenguaje: {$this->lenguajePrincipal}, Experiencia: {$this->nivelExperiencia}, Tipo: Desarrollador";
    }
    
    public function calcularSalarioTotal() {
        return $this->salarioBase + $this->aumentoSalarial;
    }
}
?>