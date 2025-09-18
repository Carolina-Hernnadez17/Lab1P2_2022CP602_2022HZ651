<?php
define("RUTA", "http://localhost/Lab1P2_2022CP602_2022HZ651/");

// Archivos de configuración
require_once __DIR__ . "/configRCMH/contenidoRCMH.php";
require_once __DIR__ . "/configRCMH/ConexionRCMH.php";

// Objetos
$contenido = new ContenidoRCMH();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tienda Libros RCMH</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <header>
        <!-- Menú principal -->
        <?php include __DIR__ . "/configRCMH/menuRCMH.php"; ?>
    </header>
    <main>
        <div class="container mt-4">
            <?php 
            if (isset($_GET["url"])) {               
                $datos = explode("/", $_GET["url"]);
                $pagina = strtolower($datos[0]);
                $accion = $datos[1] ?? "index";
                $param = $datos[2] ?? null;

                // Cargar el controlador correspondiente
                require_once $contenido->obtenerControlador($pagina);

                $nombreClase = ucfirst($pagina) . "ControladorRCMH";
                if (class_exists($nombreClase)) {
                    $controlador = new $nombreClase();
                    if (method_exists($controlador, $accion)) {
                        if ($param) {
                            $controlador->{$accion}($param);
                        } else {
                            $controlador->{$accion}();
                        }
                    } else {
                        require_once __DIR__ . "/vistasRCMH/404.php";
                    }
                } else {
                    require_once __DIR__ . "/vistasRCMH/404.php";
                }
            } else {
                require_once __DIR__ . "/vistasRCMH/inicio.php";
            }
            ?>
        </div>
    </main>
    <footer>
        <!-- Pie de página -->
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>
</body>
</html>
