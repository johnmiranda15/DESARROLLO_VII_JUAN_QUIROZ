<?php
require_once 'Empresa.php';
require_once 'Gerente.php';
require_once 'Desarrollador.php';

echo "<h1>Sistema de Gestión de Empleados - GodCode</h1>\n";
echo "<pre>\n";

$empresa = new Empresa("GodCode");

$gerente1 = new Gerente("Luis Morales", "G001", 75000, "Desarrollo");
$gerente2 = new Gerente("Regulo Barrios", "G002", 80000, "Sistemas");

$dev1 = new Desarrollador("Clovis Avila", "D001", 55000, "PHP", "Senior");
$dev2 = new Desarrollador("Itza Gonzalez", "D002", 45000, "JavaScript", "Semi-Senior");
$dev3 = new Desarrollador("Grace Quiroz", "D003", 35000, "Python", "Junior");

$empresa->agregarEmpleado($gerente1);
$empresa->agregarEmpleado($gerente2);
$empresa->agregarEmpleado($dev1);
$empresa->agregarEmpleado($dev2);
$empresa->agregarEmpleado($dev3);

$empresa->listarEmpleados();

echo "=== NÓMINA INICIAL ===\n";
$nominaInicial = $empresa->calcularNominaTotal();
echo "Nómina total inicial: $" . number_format($nominaInicial, 2) . "\n";
echo "Total de empleados: " . $empresa->getTotalEmpleados() . "\n\n";

$empresa->evaluarTodos();

echo "=== NÓMINA FINAL ===\n";
$nominaFinal = $empresa->calcularNominaTotal();
echo "Nómina total final: $" . number_format($nominaFinal, 2) . "\n";
echo "Diferencia: $" . number_format($nominaFinal - $nominaInicial, 2) . "\n\n";

echo "Sistema funcionando correctamente ✓\n";

echo "</pre>\n";
echo "<p><strong>GodCode - Sistema completado exitosamente!</strong></p>";
?>