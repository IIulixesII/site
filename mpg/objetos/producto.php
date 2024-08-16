<?php

class Producto {
    public $imagen;
    public $nombre;
    public $tipo;
    public $precio;

    public function __construct($imagen, $nombre, $tipo, $precio) {
        $this->imagen = $imagen;
        $this->nombre = $nombre;
        $this->tipo = $tipo;
        $this->precio = $precio;
    }

    public function mostrarImagen() {
        return "<img src='{$this->imagen}' alt='{$this->nombre}' style='max-width: 200px;'>";
    }
}
?>
