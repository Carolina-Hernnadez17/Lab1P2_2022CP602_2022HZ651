<?php
// menuRCMH.php
?>

<nav class="navbar navbar-expand-lg navbar-light bg-light mb-3">
  <div class="container">
    <a class="navbar-brand" href="<?= RUTA; ?>indexRCMH.php">Tienda Libros RCMH</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarRCMH" aria-controls="navbarRCMH" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarRCMH">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item"><a class="nav-link" href="<?= RUTA; ?>indexRCMH.php?url=autores/listar">Autores</a></li>
        <li class="nav-item"><a class="nav-link" href="<?= RUTA; ?>indexRCMH.php?url=libros/listar">Libros</a></li>
        <li class="nav-item"><a class="nav-link" href="<?= RUTA; ?>indexRCMH.php?url=categorias/listar">Categorías</a></li>
      </ul>
    </div>
  </div>
</nav>
