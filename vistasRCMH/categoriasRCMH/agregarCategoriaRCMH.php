<?php
require_once "../../controladoresRCMH/CategoriaControladorRCMH.php";
$controlador = new CategoriaControladorRCMH();

if($_SERVER['REQUEST_METHOD']=='POST'){
    $resultado = $controlador->agregarRCMH($_POST);
    $mensaje = $resultado ? "Categoría agregada exitosamente" : "Error: Complete el nombre";
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Agregar Categoría</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="p-4">
<div class="container">
<h2>Agregar Categoría</h2>
<?php if(isset($mensaje)) echo "<div class='alert alert-info'>$mensaje</div>"; ?>
<form method="POST">
    <div class="mb-3">
        <label>Nombre de la categoría</label>
        <input type="text" name="nombre" class="form-control" required>
    </div>
    <button class="btn btn-primary">Agregar</button>
    <a href="listarCategoriasRCMH.php" class="btn btn-secondary">Volver</a>
</form>
</div>
</body>
</html>
