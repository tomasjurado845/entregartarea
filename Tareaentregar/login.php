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

// Eliminar usuario
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_user'])) {
    $id = $_POST['id'];
    $sql = "DELETE FROM usuarios WHERE id=$id";
    $conn->query($sql);
}

// Agregar usuario
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_user'])) {
    $usuario = $_POST['usuario'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $sql = "INSERT INTO usuarios (usuario, password) VALUES ('$usuario', '$password')";
    $conn->query($sql);
}

// Listar usuarios
$sql = "SELECT * FROM usuarios";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Gestión de Usuarios</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
    <div class="container">
        <h1>Gestión de Usuarios</h1>

        <form method="POST">
            <input type="text" name="usuario" required placeholder="Usuario">
            <input type="password" name="password" required placeholder="Contraseña">
            <button type="submit" name="add_user">Agregar Usuario</button>
        </form>

        <h2>Lista de Usuarios</h2>
        <table>
            <tr>
                <th>ID</th>
                <th>Usuario</th>
                <th>Acciones</th>
            </tr>
            <?php if ($result && $result->num_rows > 0): ?>
                <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= $row['id'] ?></td>
                    <td><?= $row['usuario'] ?></td>
                    <td>
                        <form method="POST" style="display:inline;">
                            <input type="hidden" name="id" value="<?= $row['id'] ?>">
                            <button type="submit" name="delete_user" onclick="return confirm('¿Estás seguro de que quieres eliminar este usuario?');">Eliminar</button>
                        </form>
                        <a href="editar_usuario.php?id=<?= $row['id'] ?>">Editar</a>
                    </td>
                </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="3">No hay usuarios registrados.</td>
                </tr>
            <?php endif; ?>
        </table>

        <?php $conn->close(); ?>
    </div>
</body>
</html>
