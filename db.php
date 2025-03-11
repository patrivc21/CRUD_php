<?php 
 // Este archivo contiene la configuracion y conexion para la base de datos
$db_host = 'localhost';
$db_name = 'crud_pdo_db';
$db_user = 'root';
$db_pass = '';

// Opciones PDO 
$db_options = array(
    PDO::ATTR_ERRMODE               => PDO::ERRMODE_EXCEPTION, // Manejo de errores con excepciones
    PDO::ATTR_DEFAULT_FETCH_MODE    => PDO:: FETCH_ASSOC, // Modo de obtencion de resultados
    PDO::ATTR_EMULATE_PREPARES      => false,   // Emulacion de consultas prepraradas
);

try {
    // Crear instancia PDO
    $pdo = new PDO("mysql:host=$db_host;dbname=$db_name;charset=utf8", $db_user, $db_pass, $db_options);
} catch (PDOException $e) {
    // Manejo de errores de conexion
    echo "Error de conexion a la base de datos: " . $e->getMessage();
    exit;
}

?>