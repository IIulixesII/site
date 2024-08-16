<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Search Example</title>
  <!-- Bootstrap CSS -->
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.1.0/css/bootstrap.min.css" rel="stylesheet">
  <style>
    .navbar {
      display: flex;
      flex-direction: column;
      align-items: center;
      padding: 10px;
    }
    .navbar .d-flex {
      width: 100%;
      max-width: 600px; /* Ajusta este valor si es necesario */
      justify-content: center;
    }
    .navbar .buttons {
      margin-top: 10px;
    }
    @media (min-width: 768px) {
      .navbar {
        flex-direction: row;
        justify-content: space-between;
        align-items: center;
      }
      .navbar .d-flex {
        width: auto;
        max-width: none;
      }
      .navbar .buttons {
        margin-top: 0;
      }
    }
    #searchResults {
      margin-top: 20px;
    }
  </style>
</head>
<body>

<div class="navbar">
  <div class="d-flex justify-content-center">
    <form id="searchForm" class="d-flex" role="search">
      <input id="searchInput" class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
      <button id="searchButton" class="btn btn-outline-success" type="submit">Search</button>
    </form>
  </div>
  <div class="buttons d-flex justify-content-center mt-2 mt-md-0">
    <button class="btn btn-outline-primary me-2" type="button" onclick="window.location.href='registrar.php'">Registrarse</button>
    <button class="btn btn-outline-secondary" type="button">Iniciar sesión</button>
  </div>
</div>


<!-- Bootstrap JS -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.0/js/bootstrap.bundle.min.js"></script>
<script>
  document.getElementById("searchForm").addEventListener("submit", function(event) {
    event.preventDefault(); // Evita que el formulario se envíe de forma predeterminada
    
    var searchTerm = document.getElementById("searchInput").value.trim(); // Obtiene el término de búsqueda y elimina espacios en blanco al inicio y al final
    
    // Llama a la función para realizar la búsqueda y ocultar los <h1>
    showSearchResults(searchTerm);
  });

  function showSearchResults(searchTerm) {
    // Oculta todos los elementos <h1> en la página
    var headings = document.querySelectorAll("h1");
    headings.forEach(function(heading) {
      heading.style.display = "none";
    });

    // Muestra los resultados de búsqueda
    var searchResultsContainer = document.getElementById("searchResults");
    searchResultsContainer.innerHTML = "<p>Resultados de búsqueda para: <strong>" + searchTerm + "</strong></p>";
  }
</script>

</body>
</html>
