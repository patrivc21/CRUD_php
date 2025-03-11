<?php 
require 'db.php';
$id = $_GET['id'] ?? null;

// Si no hay, vuelta a la pagina principal
if(!$id){
    header('Location: index.php');
    exit;
}

try {
    $sql = $pdo->prepare('DELETE FROM usuarios WHERE id = :id');
    $sql -> execute(['id'=>$id]);
    header('Location: index.php');
    exit;
} catch(PDOException $e){
    echo "Error al eliminar el usuario: " . $e->getMessage();
}
?>