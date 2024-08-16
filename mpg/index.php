<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="estilo.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        .productos-container {
            position: relative;
            overflow: hidden; /* Oculta cualquier desbordamiento en pantallas grandes */
        }
        .productos {
            display: flex;
            overflow-x: hidden; /* Oculta el scroll horizontal en pantallas grandes */
            scroll-behavior: smooth;
            padding-bottom: 10px; /* Espacio para que no se corte el contenido */
        }
        .producto {
            flex: 0 0 200px; /* Ancho de cada producto */
            margin-right: 10px; /* Espacio entre productos */
            display: flex;
            flex-direction: column;
            align-items: center; /* Centrar el contenido de cada producto */
            justify-content: space-between; /* Asegura que el contenido ocupe todo el espacio disponible */
        }
        .btn-prev, .btn-next {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            background-color: rgba(0, 0, 0, 0.5);
            color: white;
            border: none;
            padding: 10px;
            cursor: pointer;
        }
        .btn-prev {
            left: 10px;
        }
        .btn-next {
            right: 10px;
        }

        /* Mostrar scroll en dispositivos móviles */
        @media (max-width: 767px) {
            .productos-container {
                overflow: auto; /* Permite el scroll horizontal en móviles */
            }
            .productos {
                overflow-x: scroll; /* Muestra el scroll horizontal en móviles */
            }
            .btn-prev, .btn-next {
                display: none; /* Oculta los botones de navegación en móviles */
            }
        }
    </style>
</head>
<body>
<?php include_once "nav.php"; ?>

<div id="carouselExampleSlidesOnly" class="carousel slide" data-bs-ride="carousel">
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="imagenes/fondo.jpeg" class="d-block w-100" alt="...">
    </div>
  </div>
</div>

<div id="searchResults" class="container mt-4">
<H1 class="text-center">Electronica</H1>
</div>

<?php
include 'conexion.php';
include 'objetos/producto.php';

// Crear una instancia de la clase Conexion
$database = new Conexion();
$conn = $database->conn;

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Consultar los datos de los productos
$sql = "SELECT imagen, nombre, tipo, precio FROM producto WHERE tipo = 'Electrónica'";
$result = $conn->query($sql);

if ($result === false) {
    die("Error en la consulta: " . $conn->error);
}

$productos = [];
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $producto = new Producto($row["imagen"], $row["nombre"], $row["tipo"], $row["precio"]);
        $productos[] = $producto;
    }
} else {
    echo "No hay productos disponibles.";
}

// Cerrar la conexión
?>

<div class="productos-container">
    <button class="btn-prev">&#10094;</button>
    <div class="productos">
        <?php
        foreach ($productos as $producto) {
            echo '<div class="producto">';
            echo $producto->mostrarImagen();
            echo '<h3>' . htmlspecialchars($producto->nombre) . '</h3>';
            echo '<h3>' . htmlspecialchars($producto->precio) . '$</h3>';
            echo '</div>';
        }
        ?>
    </div>
    <button class="btn-next">&#10095;</button>
</div>

<H1 class="text-center">Ropa</H1>
<?php

$sql = "SELECT imagen, nombre, tipo, precio FROM producto WHERE tipo = 'Ropa'";
$result = $conn->query($sql);

if ($result === false) {
    die("Error en la consulta: " . $conn->error);
}

$productos = [];
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $producto = new Producto($row["imagen"], $row["nombre"], $row["tipo"], $row["precio"]);
        $productos[] = $producto;
    }
} else {
    echo "No hay productos disponibles.";
}

// Cerrar la conexión
$conn->close();
?>

<div class="productos-container">
    <button class="btn-prev">&#10094;</button>
    <div class="productos">
        <?php
        foreach ($productos as $producto) {
            echo '<div class="producto">';
            echo $producto->mostrarImagen();
            echo '<h3>' . htmlspecialchars($producto->nombre) . '</h3>';
            echo '<h3>' . htmlspecialchars($producto->precio) .'$</h3>';
            echo '</div>';
        }
        ?>
    </div>
    <button class="btn-next">&#10095;</button>
</div>


<script>
  var productosContainers = document.querySelectorAll(".productos-container .productos");
  var btnsPrev = document.querySelectorAll(".btn-prev");
  var btnsNext = document.querySelectorAll(".btn-next");

  var scrollAmount = 600; // Ajusta la cantidad de desplazamiento aquí

  btnsPrev.forEach(function(btnPrev, index) {
    btnPrev.addEventListener("click", function() {
      productosContainers[index].scrollLeft -= scrollAmount;
    });
  });

  btnsNext.forEach(function(btnNext, index) {
    btnNext.addEventListener("click", function() {
      productosContainers[index].scrollLeft += scrollAmount;
    });
  });
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script>
  document.getElementById("searchButton").addEventListener("click", function() {
    var searchTerm = document.getElementById("searchInput").value.toLowerCase();
    var productos = document.querySelectorAll(".producto");
    
    productos.forEach(function(producto) {
      var nombreProducto = producto.querySelector("h3").innerText.toLowerCase();
      var mostrarProducto = nombreProducto.includes(searchTerm);
      producto.style.display = mostrarProducto ? "block" : "none";
    });
  });
</script>
<?php include_once "nav.php"; ?>
</body>
</html>
