<?php 
require 'db.php';
include 'templates/header.php';

// Declaramos variables
$nombre = $apellidos = $email = $telefono = '';
$errores = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validar nombre
    if (empty($_POST['nombre'])) { // Si esta vacio
        $errores['nombre'] = 'El nombre es obligatorio.'; // Agregamos error al array de errores
    } else {
        $nombre = trim($_POST['nombre']);
    }

    // Validar apellidos
    if (empty($_POST['apellidos'])) {
        $errores['apellidos'] = 'El apellido es obligatorio.';
    } else {
        $apellidos = trim($_POST['apellidos']);
    }

    if (empty($_POST['email'])) {
        $errores['email'] = 'El email es obligatorio.';
    } elseif (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) { // Lo usamos para ver que el formato del email es valido
        $errores['email'] = 'El correo electrónico no es válido.';
    } else {
        $email = trim($_POST['email']);
    }

    if (empty($_POST['telefono'])) { 
        $errores['telefono'] = 'El telefono es obligatorio.'; 
    } else {
        $telefono = trim($_POST['telefono']);
    }

    // SI no hay errores
    if(empty($errores)){
        try {
            $sql = 'INSERT INTO usuarios (nombre, apellidos, email, telefono) VALUES (:nombre, :apellidos, :email, :telefono)';
            $result = $pdo->prepare($sql);
            $result->execute(['nombre' => $nombre, 'apellidos' => $apellidos, 'email' => $email, 'telefono' => $telefono]);
            header('Location: index.php');
            exit;
        } catch (PDOException $e){
            if ($e->errorInfo[2] == 1062) {
                $errores['email'] = 'El correo electrónico ya está registrado.';
            } else {
                echo "Error al insertar el usuario: " . $e->getMessage();
            }
        }
    }
}
?>

<div class="alinear">
<a href="index.php"><button class="btn-volver"></button></a>
    <h2 class="titulo">Agregar nuevo usuario</h2>
</div>


<form method="POST" class="formulario">
    <label for="nombre">Nombre</label>
    <input type="text" name="nombre" id="nombre" value="<?php echo htmlspecialchars($nombre); ?>" />
    <?php if(isset($errores['nombre'])):?>
        <p class="error"><?= $errores['nombre'] ?></p>
    <?php endif; ?>

    <label for="apellidos">Apellidos</label>
    <input type="text" name="apellidos" id="apellidos" value="<?= htmlspecialchars($apellidos); ?>" />
    <?php if(isset($errores['apellidos'])):?>
        <p class="error"><?= $errores['apellidos'] ?></p>
    <?php endif; ?>

    <label for="email">Email</label>
    <input type="email" name="email" id="email" value="<?= htmlspecialchars($email); ?>" />
    <?php if(isset($errores['email'])):?>
        <p class="error"><?= $errores['email'] ?></p>
    <?php endif; ?>

    <label for="telefono">Telefono</label>
    <input type="tel" name="telefono" id="telefono" value="<?= htmlspecialchars($telefono); ?>" />
    <?php if(isset($errores['telefono'])):?>
        <p class="error"><?= $errores['telefono'] ?></p>
    <?php endif; ?>

    <div class="centrar">
        <button type="submit">Agregar usuario</button>
    </div>
</form>

<?php include 'templates/footer.php'; ?>