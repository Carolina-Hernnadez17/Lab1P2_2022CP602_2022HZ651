<?php 
define("RUTA", "http://localhost/Lab1P2_2022CP602_2022HZ651/");

// Archivos de configuración
require_once "configRCMH/contenidoRCMH.php";

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

<?php include "configRCMH/menuRCMH.php"; ?>

<div class="container mt-4">
<?php 
if(isset($_GET["url"])){
    $datos = explode("/", $_GET["url"]);
    $pagina = $datos[0];
    
    $archivo = $contenido->obtenerContenido($pagina);    

    if(file_exists($archivo)){
        require_once $archivo;
    } else {
        echo "<h3>Página no encontrada</h3>";
    }
} else {
    // Vista inicial
    echo "<h2>Bienvenido a la Tienda de Libros RCMH</h2>";
    echo "<p>Seleccione una opción del menú para comenzar.</p>";
}
?>
</div>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>
</body>
</html>
