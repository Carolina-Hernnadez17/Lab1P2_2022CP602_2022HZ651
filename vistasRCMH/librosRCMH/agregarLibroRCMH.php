<?php
require_once "../../controladoresRCMH/LibroControladorRCMH.php";
require_once "../../controladoresRCMH/AutorControladorRCMH.php";

$controlador = new LibroControladorRCMH();
$autorControlador = new AutorControladorRCMH();
$autores = $autorControlador->listarRCMH();

if($_SERVER['REQUEST_METHOD']=='POST'){
    $resultado = $controlador->agregarRCMH($_POST);
    $mensaje = $resultado ? "Libro agregado exitosamente" : "Error: Complete los campos obligatorios";
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Agregar Libro</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="p-4">
<div class="container">
<h2>Agregar Libro</h2>
<?php if(isset($mensaje)) echo "<div class='alert alert-info'>$mensaje</div>"; ?>
<form method="POST">
    <div class="mb-3">
        <label>Título</label>
        <input type="text" name="titulo" class="form-control" required>
    </div>
    <div class="mb-3">
        <label>Autor</label>
        <select name="id_autor" class="form-control" required>
            <option value="">--Seleccionar--</option>
            <?php foreach($autores as $a){ ?>
                <option value="<?= $a['id_autor'] ?>"><?= $a['nombre'] ?></option>
            <?php } ?>
        </select>
    </div>
    <div class="mb-3">
        <label>Portada (URL)</label>
        <input type="text" name="portada" class="form-control">
    </div>
    <div class="mb-3">
        <label>Stock</label>
        <input type="number" name="stock" class="form-control" value="1" min="1" required>
    </div>
    <button class="btn btn-primary">Agregar</button>
    <a href="listarLibrosRCMH.php" class="btn btn-secondary">Volver</a>
</form>
</div>
</body>
</html>
