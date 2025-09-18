<?php
require_once "../../controladoresRCMH/AutorControladorRCMH.php";
$controlador = new AutorControladorRCMH();

if($_SERVER['REQUEST_METHOD']=='POST'){
    $resultado = $controlador->agregarRCMH($_POST);
    $mensaje = $resultado ? "Autor agregado exitosamente" : "Error: Complete todos los campos";
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Agregar Autor</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="p-4">
<div class="container">
<h2>Agregar Autor</h2>
<?php if(isset($mensaje)) echo "<div class='alert alert-info'>$mensaje</div>"; ?>
<form method="POST">
    <div class="mb-3">
        <label>Nombre</label>
        <input type="text" name="nombre" class="form-control" required>
    </div>
    <div class="mb-3">
        <label>Nacionalidad</label>
        <input type="text" name="nacionalidad" class="form-control" required>
    </div>
    <button class="btn btn-primary">Agregar</button>
    <a href="listarAutoresRCMH.php" class="btn btn-secondary">Volver</a>
</form>
</div>
</body>
</html>
