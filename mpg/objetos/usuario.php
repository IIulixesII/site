<?php

class Usuario {
    public $fecha_nacimiento;
    public $nombre;
    public $genero;
    public $localidad;

    public function __construct($fecha_nacimiento, $nombre, $genero, $localidad) {
        $this->fecha_nacimiento = $fecha_nacimiento;
        $this->nombre = $nombre;
        $this->genero = $genero;
        $this->localidad = $localidad;
    }

    public function subirusuario() {
        // Crear una instancia de la clase Conexion
        $conexion = new Conexion();
        $conn = $conexion->conn;

        // Preparar y vincular la consulta SQL
        $stmt = $conn->prepare("INSERT INTO usuarios (fecha_nacimiento, nombre, genero, localidad) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $this->fecha_nacimiento, $this->nombre, $this->genero, $this->localidad);

        // Ejecutar la consulta
        if ($stmt->execute()) {
            echo "Usuario subido exitosamente";
        } else {
            echo "Error: " . $stmt->error;
        }

        // Cerrar la conexión
        $stmt->close();
        $conexion->close();
    }
}

// Ejemplo de uso
$usuario = new Usuario("1990-01-01", "Juan Perez", "M", "Buenos Aires");
$usuario->subirusuario();
