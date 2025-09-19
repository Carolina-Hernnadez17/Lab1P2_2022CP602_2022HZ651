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
                        <li class="nav-item"><a class="nav-link" href="<?= RUTA; ?>autores">Autores</a></li>
                        <li class="nav-item"><a class="nav-link" href="<?= RUTA; ?>categorias">Categorías</a></li>
                        <li class="nav-item"><a class="nav-link" href="<?= RUTA; ?>libros">Libros</a></li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <main class="container mt-4">
        <?php 
        if(isset($_GET["url"])) {
            $datos = explode("/", $_GET["url"]);
            $pagina = $datos[0];
            $accion = $datos[1] ?? "index";

            // Obtenemos la vista
            $vista = $contenido->obtenerContenido($pagina, $accion);

            if($vista) {
                require_once $vista;
            } else {
                echo "<div class='alert alert-danger'>Página no encontrada: <strong>$pagina / $accion</strong></div>";
            }

            // Llamamos al controlador correspondiente si existe
            $nombreClase = ucfirst($pagina) . "Controller";
            if(class_exists($nombreClase)){
                $controlador = new $nombreClase();
                if(method_exists($controlador, $accion)){
                    if(isset($datos[2])){
                        $controlador->{$accion}($datos[2]);
                    } else {
                        $controlador->{$accion}();
                    }
                }
            }
        } else {
            // Página de inicio
            if(file_exists("vistas/inicio.php")){
                require_once "vistas/inicio.php";
            } else {
                echo "<h2>Bienvenido a la tienda de libros</h2>";
            }
        }
        ?>
    </main>

    <footer class="bg-light text-center py-3 mt-4">
        &copy; <?= date("Y"); ?> Mi Tienda de Libros
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
