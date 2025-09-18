<?php
require_once "../../controladoresRCMH/CategoriaControladorRCMH.php";

$controlador = new CategoriaControladorRCMH();
$dao = $controlador->getDao();
$categorias = $dao->listarRCMH();

// Capturar filtros
$busqueda = $_GET['buscar'] ?? '';
$filtroConLibros = $_GET['conLibros'] ?? '';

// Filtrar categorías
$filtrados = [];
foreach($categorias as $c){
    if($busqueda && stripos($c['nombre'], $busqueda)===false){
        continue;
    }
    if($filtroConLibros=='1' && $dao->contarLibrosRCMH($c['id_categoria'])==0){
        continue;
    }
    $filtrados[] = $c;
}

// Eliminar categoría
if(isset($_GET['eliminar'])){
    $dao->eliminarRCMH($_GET['eliminar']);
    header("Location:listarCategoriasRCMH.php");
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Lista de Categorías</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="p-4">
<div class="container">
    <h2>Lista de Categorías</h2>

    <!-- FORMULARIO DE FILTROS -->
    <form method="GET" class="mb-3">
        <div class="row g-2 align-items-end">
            <div class="col-md-6">
                <input type="text" name="buscar" class="form-control" placeholder="Buscar por nombre" value="<?= htmlspecialchars($busqueda) ?>">
            </div>
            <div class="col-md-4">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="conLibros" value="1" <?= $filtroConLibros=='1'?'checked':'' ?>>
                    <label class="form-check-label">Solo categorías con libros</label>
                </div>
            </div>
            <div class="col-md-2">
                <button class="btn btn-primary w-100">Filtrar</button>
            </div>
        </div>
    </form>

    <a href="agregarCategoriaRCMH.php" class="btn btn-success mb-2">Agregar Categoría</a>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Libros Asociados</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($filtrados as $c){ ?>
                <tr>
                    <td><?= htmlspecialchars($c['nombre']) ?></td>
                    <td><?= $dao->contarLibrosRCMH($c['id_categoria']) ?></td>
                    <td>
                        <a href="editarCategoriaRCMH.php?id=<?= $c['id_categoria'] ?>" class="btn btn-warning btn-sm">Editar</a>
                        <a href="?eliminar=<?= $c['id_categoria'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('¿Eliminar categoría?')">Eliminar</a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
</body>
</html>
