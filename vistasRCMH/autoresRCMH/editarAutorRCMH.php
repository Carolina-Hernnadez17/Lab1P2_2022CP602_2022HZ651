<?php
require_once "../../controladoresRCMH/AutorControladorRCMH.php";
$controlador = new AutorControladorRCMH();
$autor = $controlador->getDao()->obtenerRCMH($_GET['id']);

if($_SERVER['REQUEST_METHOD']=='POST'){
    $data = [
        'id_autor' => $_GET['id'],
        'nombre' => $_POST['nombre'],
        'nacionalidad' => $_POST['nacionalidad']
    ];
    $controlador->actualizarRCMH($data);
    header("Location:listarAutoresRCMH.php");
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Editar Autor</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="p-4">
<div class="container">
<h2>Editar Autor</h2>
<form method="POST">
<div class="mb-3">
<label>Nombre</label>
<input type="text" name="nombre" class="form-control" value="<?= $autor['nombre'] ?>" required>
</div>
<div class="mb-3">
<label>Nacionalidad</label>
<input type="text" name="nacionalidad" class="form-control" value="<?= $autor['nacionalidad'] ?>" required>
</div>
<button class="btn btn-primary">Actualizar</button>
<a href="listarAutoresRCMH.php" class="btn btn-secondary">Cancelar</a>
</form>
</div>
</body>
</html>
