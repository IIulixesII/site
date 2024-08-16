<?php

session_start(); // reaunuda las sesciones asociadas a la cuenta atravez de una cookie por lo que entendi ojala este bien 

// compara con el !sset si la sesion es null o no
if (!isset($_SESSION['admin_id'])) {
    header("Location: inciarsesion.php");
    exit;
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<div>
<form action="procesar_producto.php" method="post" enctype="multipart/form-data">
    <label for="imagen">Imagen:</label>
    <input type="file" id="imagen" name="imagen" required>
    
    <label for="nombre">Nombre:</label>
    <input type="text" id="nombre" name="nombre" required>
    
    <label for="tipo">Tipo:</label>
    <select id="tipo" name="tipo" required>
        <option value="" disabled selected>Seleccione un tipo</option>
        <option value="Electrónica">Electrónica</option>
        <option value="Ropa">Ropa</option>
        <option value="Hogar">Hogar</option>
        <option value="Juguetes">Juguetes</option>
        <option value="Alimentos">Alimentos</option>
        <!-- Agrega más opciones aquí según tus necesidades -->
    </select>
    
    <label for="precio">Precio:</label>
    <input type="number" id="precio" name="precio" step="0.01" required>
    
    <button type="submit">Subir Producto</button>
</form>

 </div>
</body>
</html>