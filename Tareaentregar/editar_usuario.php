<?php
session_start();

$servername = "localhost";
$username = "root"; // Cambia esto si es necesario
$password = ""; // Cambia esto si es necesario
$database = "devolteca";

// Conectar a la base de datos
$conn = new mysqli($servername, $username, $password, $database);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Cargar datos del usuario
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM usuarios WHERE id=$id";
    $result = $conn->query($sql);
    $user = $result->fetch_assoc();
}

// Actualizar usuario
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['edit_user'])) {
    $id = $_POST['id'];
    $usuario = $_POST['usuario'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $sql = "UPDATE usuarios SET usuario='$usuario', password='$password' WHERE id=$id";
    $conn->query($sql);
    header("Location: usuarios.php"); // Redirigir después de editar
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Usuario</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
    <div class="container">
        <h1>Editar Usuario</h1>
        <?php if (isset($user)): ?>
        <form method="POST">
            <input type="hidden" name="id" value="<?= $user['id'] ?>">
            <input type="text" name="usuario" value="<?= $user['usuario'] ?>" required placeholder="Usuario">
            <input type="password" name="password" placeholder="Nueva Contraseña">
            <button type="submit" name="edit_user">Actualizar Usuario</button>
        </form>
        <?php else: ?>
            <p>Usuario no encontrado.</p>
        <?php endif; ?>
    </div>
</body>
</html>
