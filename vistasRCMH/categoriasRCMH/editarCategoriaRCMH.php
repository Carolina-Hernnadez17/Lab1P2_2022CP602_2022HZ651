<?php
require_once "../../controladoresRCMH/CategoriaControladorRCMH.php";
$controlador = new CategoriaControladorRCMH();
$categoria = $controlador->getDao()->obtenerRCMH($_GET['id']);

if($_SERVER['REQUEST_METHOD']=='POST'){
    $data = [
        'id_categoria' => $_GET['id'],
        'nombre' => $_POST['nombre']
    ];
    $controlador->actualizarRCMH($data);
    header("Location:listarCategoriasRCMH.php");
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Editar Categoría</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="p-4">
<div class="container">
<h2>Editar Categoría</h2>
<form method="POST">
<div class="mb-3">
<label>Nombre</label>
<input type="text" name="nombre" class="form-control" value="<?= $categoria['nombre'] ?>" required>
</div>
<button class="btn btn-primary">Actualizar</button>
<a href="listarCategoriasRCMH.php" class="btn btn-secondary">Cancelar</a>
</form>
</div>
</body>
</html>
