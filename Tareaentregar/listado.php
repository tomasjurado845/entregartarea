<?php
include("includes/db.php"); // Incluye el archivo de conexión a la base de datos

// Verifica si la conexión es exitosa
if (!$conx) {
    die("Conexión fallida: " . mysqli_connect_error()); // Si falla, muestra un mensaje de error
}

// Realiza una consulta para seleccionar todos los usuarios de la tabla
$resultado = $conx->query("SELECT * FROM usuarios");
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"> <!-- Define la codificación de caracteres como UTF-8 -->
    <meta name="viewport" content="width=device-width, initial-scale=1"> <!-- Permite que la página sea responsive -->
    <title>Listado de Usuarios</title> <!-- Título de la página -->
    <style>
        body {
            font-family: Arial, sans-serif; /* Establece la fuente para el texto */
            margin: 20px; /* Añade un margen alrededor del cuerpo */
            background-color: #e9f5e9; /* Color de fondo suave */
        }
        h1 {
            color: #4CAF50; /* Color verde para el título */
        }
        table {
            width: 100%; /* Hace que la tabla ocupe el 100% del ancho disponible */
            border-collapse: collapse; /* Colapsa los bordes de la tabla */
            margin-top: 20px; /* Añade un margen superior a la tabla */
        }
        th, td {
            padding: 12px; /* Espacio interno de las celdas */
            border: 1px solid #a5d6a7; /* Borde de las celdas */
            text-align: left; /* Alinea el texto a la izquierda */
        }
        th {
            background-color: #4CAF50; /* Color de fondo verde para los encabezados */
            color: white; /* Color del texto en los encabezados */
        }
        tr:nth-child(even) {
            background-color: #f1f1f1; /* Color de fondo gris claro para filas pares */
        }
        a {
            text-decoration: none; /* Sin subrayado en los enlaces */
            color: #4CAF50; /* Color del texto de los enlaces */
        }
        a:hover {
            text-decoration: underline; /* Subrayado al pasar el mouse sobre el enlace */
        }
    </style>
</head>
<body>
    <h1>Listado de Usuarios</h1> <!-- Título de la página -->
    <a href="nuevo.php" style="color: #4CAF50; font-size: 18px; text-decoration: none;">Agregar nuevo Usuario</a> <!-- Enlace para agregar un nuevo usuario -->
    <table>
        <thead>
            <tr>
                <th>Id</th> <!-- Encabezado para el ID -->
                <th>Email</th> <!-- Encabezado para el Email -->
                <th>Password</th> <!-- Encabezado para el Password -->
                <th>Acciones</th> <!-- Encabezado para las acciones -->
            </tr>
        </thead>
        <tbody>
        <?php while ($fila = $resultado->fetch_object()) { ?> <!-- Itera sobre cada fila del resultado -->
            <tr>
                <td><?php echo $fila->id; ?></td> <!-- Muestra el ID del usuario -->
                <td><?php echo $fila->email; ?></td> <!-- Muestra el Email del usuario -->
                <td><?php echo $fila->password; ?></td> <!-- Muestra el Password del usuario -->
                <td>
                    <a href="editar.php?id=<?php echo $fila->id; ?>">Editar</a> | <!-- Enlace para editar el usuario -->
                    <a href="eliminar.php?id=<?php echo $fila->id; ?>">Eliminar</a> <!-- Enlace para eliminar el usuario -->
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
</body>
</html>
