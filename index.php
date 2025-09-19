<?php
require_once "config/rutas.php";

$contenido = new Contenido();
?>

<!doctype html>
<html lang="es">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Mi Tienda de Libros</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<header>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
<div class="container">
<a class="navbar-brand" href="<?= RUTA; ?>">Inicio</a>
<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
<span class="navbar-toggler-icon"></span>
</button>
<div class="collapse navbar-collapse" id="navbarNav">
<ul class="navbar-nav me-auto">
<li class="nav-item"><a class="nav-link" href="<?= RUTA; ?>autor">Autores</a></li>
<li class="nav-item"><a class="nav-link" href="<?= RUTA; ?>categoria">Categorías</a></li>
<li class="nav-item"><a class="nav-link" href="<?= RUTA; ?>libro">Libros</a></li>
</ul>
</div>
</div>
</nav>
</header>

<main class="container mt-4">
<?php
$pagina = $_GET['url'] ?? '';
$datos = explode("/", $pagina);
$controlador = $datos[0] ?: 'inicio';
$accion = $datos[1] ?? 'index';
$id = $datos[2] ?? null;

// determinar la vista
$vista = $contenido->obtenerContenido($controlador, $accion);

// cargar la vista
require_once $vista;

// cargar el controlador si existe
$nombreClase = ucfirst($controlador) . "Controller";
if(class_exists($nombreClase)){
    $c = new $nombreClase();
    if(method_exists($c, $accion)){
        if($id){
            $c->{$accion}($id);
        } else {
            $c->{$accion}();
        }
    }
}
?>
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
