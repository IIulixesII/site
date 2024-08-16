<?php
// Incluir el archivo de conexión
include 'conexion.php';

// Crear una instancia de la clase Conexion
$database = new conexion();
$conn = $database->conn;

// Verificar si la conexión se estableció correctamente
if (!$conn) {
    die("Error: No se pudo establecer la conexión a la base de datos.");
}

// Obtener datos del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $email = $_POST['email'];
    $contraseña = password_hash($_POST['contraseña'], PASSWORD_DEFAULT); // Encriptar contraseña

    // Insertar el nuevo usuario en la base de datos
    $sql = "INSERT INTO usuario (nombre, email, contraseña) VALUES ('$nombre', '$email', '$contraseña')";

    if ($conn->query($sql) === TRUE) {
        echo "Nuevo usuario creado exitosamente";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Cerrar conexión
    $database->close();
} else {
    echo "Método de solicitud no permitido";
}
?>
