<?php

session_start(); // reaunuda las sesciones asociadas a la cuenta atravez de una cookie por lo que entendi ojala este bien 

// compara con el !sset si la sesion es null o no
if (!isset($_SESSION['admin_id'])) {
    header("Location: inciarsesion.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Página protegida</title>
    <link rel="stylesheet" href="estilo.css">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
<nav class="navbar bg-dark border-bottom border-body" data-bs-theme="dark">
<div>
    <a class="navbar-brand" href="crearproducto.php">Agregar Producto</a>
  </div>
  <div >
    <a class="navbar-brand" href="#">Salir</a>
  </div>
  <div >
    <a class="navbar-brand" href="#">NaEvbar</a>
  </div>
 
</nav>
    <h1>Bienvenido, <?php echo htmlspecialchars($_SESSION['admin_nombre']); ?>!</h1>
    <p>Esta es una página protegida. Solo puedes verla si estás logueado.</p>
    <a href="logout.php">Cerrar sesión</a>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
