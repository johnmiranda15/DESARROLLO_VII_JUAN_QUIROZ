<?php
// Configurar una cookie segura
setcookie("usuario", "Juan", [
    'expires' => time() + 86400,
    'path' => '/',
    'domain' => '',
    'secure' => true,
    'httponly' => true,
    'samesite' => 'Strict'
]);

echo "Cookie segura 'usuario' creada.";
?>