<?php
// Iniciar la sesión
session_start();

// Incluir el archivo de conexión
include 'conexion.php'; // Asegúrate de que el archivo se llama 'conexion.php'

// Crear una instancia de la clase Conexion
$database = new Conexion();
$conn = $database->conn;

// Verificar si la conexión se estableció correctamente
if (!$conn) {
    die("Error: No se pudo establecer la conexión a la base de datos.");
}

// Verificar si el formulario de inicio de sesión ha sido enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $contrasena = $_POST['contrasena'];

    // Buscar el usuario en la base de datos
    $sql = "SELECT id, nombre, contrasena FROM admin WHERE nombre = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $nombre);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id, $nombre, $hash_contrasena);
        $stmt->fetch();

        // Verificar la contraseña
        if (password_verify($contrasena, $hash_contrasena)) {
            // Contraseña correcta, iniciar sesión
            $_SESSION['admin_id'] = $id;
            $_SESSION['admin_nombre'] = $nombre;
            header("Location: homeadmin.php"); // Redirigir a una página protegida
            exit;
        } else {
            echo "Contraseña incorrecta.";
        }
    } else {
        echo "No se encontró el usuario.";
    }

    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Inicio de sesión de Administrador</title>
</head>
<body>
    <form method="post" action="inciarsesion.php">
        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" required>
        <br>
        <label for="contrasena">Contraseña:</label>
        <input type="password" id="contrasena" name="contrasena" required>
        <br>
        <button type="submit">Iniciar sesión</button>
    </form>
</body>
</html>
