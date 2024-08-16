<?php
// Incluir el archivo de conexión
include 'conexion.php';

// Crear una instancia de la clase Conexion
$database = new Conexion();
$conn = $database->conn;

// Verificar que la conexión se haya establecido correctamente
if (!$conn) {
    die("Error: No se pudo establecer la conexión a la base de datos.");
}

// Verificar que el formulario ha sido enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Directorio donde se guardarán las imágenes subidas
    $target_dir = "uploads/";

    // Verificar si el directorio existe, y crearlo si no
    if (!file_exists($target_dir)) {
        mkdir($target_dir, 0777, true);
    }
    
    // Nombre del archivo subido
    $target_file = $target_dir . basename($_FILES["imagen"]["name"]);
    
    // Tipo de archivo (extensión)
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    
    // Validar si el archivo es una imagen real
    $check = getimagesize($_FILES["imagen"]["tmp_name"]);
    if ($check === false) {
        die("El archivo no es una imagen.");
    }
    
    // Validar tamaño del archivo (opcional)
    if ($_FILES["imagen"]["size"] > 5000000) { // 5MB
        die("Lo siento, tu archivo es demasiado grande.");
    }
    
    // Validar tipo de archivo
    $allowed_types = array("jpg", "jpeg", "png", "gif");
    if (!in_array($imageFileType, $allowed_types)) {
        die("Lo siento, solo se permiten archivos JPG, JPEG, PNG y GIF.");
    }
    
    // Intentar mover el archivo subido al directorio de destino
    if (!move_uploaded_file($_FILES["imagen"]["tmp_name"], $target_file)) {
        die("Lo siento, hubo un error al subir tu archivo. Ruta del archivo: " . $target_file);
    }

    $nombre = $_POST['nombre'];
    $tipo = $_POST['tipo'];
    $precio = $_POST['precio'];

    $sql = "INSERT INTO producto (imagen, nombre, tipo, precio) VALUES (?, ?, ?, ?)";
    
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("ssss", $target_file, $nombre, $tipo, $precio);
        
        if ($stmt->execute()) {
            echo "El producto ha sido subido correctamente.";
        } else {
            echo "Error en la ejecución de la consulta: " . $stmt->error;
        }
        
        $stmt->close();
    } else {
        echo "Error en la preparación de la consulta: " . $conn->error;
    }

    // Cerrar la conexión
    $conn->close();
} else {
    echo "Método de solicitud no permitido";
}
?>
