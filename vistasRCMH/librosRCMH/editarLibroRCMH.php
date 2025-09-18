<?php
require_once "../../controladoresRCMH/LibroControladorRCMH.php";
require_once "../../controladoresRCMH/AutorControladorRCMH.php";

$controlador = new LibroControladorRCMH();
$autorControlador = new AutorControladorRCMH();

$libro = $controlador->getDao()->obtenerRCMH($_GET['id']);
$autores = $autorControlador->listarRCMH();

if($_SERVER['REQUEST_METHOD']=='POST'){
    $data = [
        'id_libro' => $_GET['id'],
        'titulo' => $_POST['titulo'],
        'id_autor' => $_POST['id_autor'],
        'portada' => $_POST['portada'],
        'stock' => $_POST['stock'],
        'disponible' => $_POST['disponible']
    ];
    $controlador->actualizarRCMH($data);
    header("Location:listarLibrosRCMH.php");
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Editar Libro</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="p-4">
<div class="container">
<h2>Editar Libro</h2>
<form method="POST">
<div class="mb-3">
<label>Título</label>
<input type="text" name="titulo" class="form-control" value="<?= $libro['titulo'] ?>" required>
</div>
<div class="mb-3">
<label>Autor</label>
<select name="id_autor" class="form-control" required>
    <?php foreach($autores as $a){ ?>
        <option value="<?= $a['id_autor'] ?>" <?= $a['id_autor']==$libro['id_autor']?'selected':'' ?>><?= $a['nombre'] ?></option>
    <?php } ?>
</select>
</div>
<div class="mb-3">
<label>Portada (URL)</label>
<input type="text" name="portada" class="form-control" value="<?= $libro['portada'] ?>">
</div>
<div class="mb-3">
<label>Stock</label>
<input type="number" name="stock" class="form-control" value="<?= $libro['stock'] ?>" min="1" required>
</div>
<div class="mb-3">
<label>Disponible</label>
<select name="disponible" class="form-control">
<option value="1" <?= $libro['disponible']==1?'selected':'' ?>>Sí</option>
<option value="0" <?= $libro['disponible']==0?'selected':'' ?>>No</option>
</select>
</div>
<button class="btn btn-primary">Actualizar</button>
<a href="listarLibrosRCMH.php" class="btn btn-secondary">Cancelar</a>
</form>
</div>
</body>
</html>
