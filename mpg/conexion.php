<?php

class Conexion {
    private $servername = "localhost";  // Cambia esto si es necesario
    private $username = "root";         // Cambia esto por el nombre de usuario de tu base de datos
    private $password = "";             // Cambia esto por la contraseña de tu base de datos
    private $dbname = "tienda";         // Cambia esto por el nombre de tu base de datos
    private $port = 3306;               // Cambia esto por el número de puerto de tu servidor MySQL
    public $conn;

    public function __construct() {
        // Crear la conexión
        $this->conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname, $this->port);

        // Verificar la conexión
        if ($this->conn->connect_error) {
            die("Conexión fallida: " . $this->conn->connect_error);
        }
    }

    public function close() {
        // Cerrar la conexión
        $this->conn->close();
    }
}
?>
