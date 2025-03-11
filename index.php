<?php 
// Pagina principal 

require 'db.php';
include 'templates/header.php';

// Obtenemos lista usuarios
try {
    $sql = $pdo->query('SELECT * FROM usuarios ORDER BY id ASC');
    $usuarios = $sql->fetchAll();
} catch(PDOException $e){
    echo "Error al obtener los usuarios: " . $e->getMessage();
}

?>

<h1 class="titulo">Lista de usuarios</h1>

<div style="margin-bottom: 20px; margin-top: 20px;">
    <a href="create.php"><button class="btn-agregar">Agregar usuarios</button></a>
</div>

<div class="table-container">
    <table>
        <tr>
            <th class="text-center">ID</th>
            <th class="text-center">Nombre</th>            
            <th class="text-center">Apellidos</th>           
            <th class="text-center">Email</th>           
            <th class="text-center">Telefono</th>
            <th></th>
        </tr>
        <?php if($usuarios): ?>
            <?php foreach($usuarios as $usuario): ?>
                <tr>
                    <td class="text-center"><?php echo htmlspecialchars($usuario['id']); ?></td> <!-- htmlspecialchars se usa para evitar inyecciones -->
                    <td class="text-center"><?php echo htmlspecialchars($usuario['nombre']); ?></td>
                    <td class="text-center"><?php echo htmlspecialchars($usuario['apellidos']); ?></td>
                    <td class="text-center"><?php echo htmlspecialchars($usuario['email']); ?></td>
                    <td class="text-center"><?php echo htmlspecialchars($usuario['telefono']); ?></td>
                    <td>
                        <div class="centrar">
                            <a href="update.php?id=<?php echo $usuario['id']; ?>"><button style="margin-right: 10px;">Editar</button></a>
                            <a href="delete.php?id=<?php echo $usuario['id']; ?>"><button>Eliminar</button></a>
                        </div>
                    </td>
                </tr>
            <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td>No hay usuarios registrados. </td>
                </tr>
            <?php endif; ?>
        
    </table>
</div>

<?php 
include 'templates/footer.php';
?>