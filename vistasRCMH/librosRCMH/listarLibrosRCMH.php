<?php
require_once "../../controladoresRCMH/LibroControladorRCMH.php";
require_once "../../controladoresRCMH/CategoriaControladorRCMH.php";

$controlador = new LibroControladorRCMH();
$categoriaControlador = new CategoriaControladorRCMH();

$daoLibro = $controlador->getDao();
$libros = $daoLibro->listarRCMH();
$categorias = $categoriaControlador->listarRCMH();

// Capturar filtros
$busqueda = $_GET['buscar'] ?? '';
$filtroCategorias = $_GET['categoria'] ?? [];
$filtroDisponible = $_GET['disponible'] ?? '';

// Filtrar libros
$filtrados = [];
foreach($libros as $l){
    // Filtro de búsqueda
    if($busqueda && stripos($l['titulo'], $busqueda)===false && stripos($l['autor_nombre'], $busqueda)===false){
        continue;
    }

    // Filtro de categoría
    if(!empty($filtroCategorias)){
        $sql = "SELECT id_categoria FROM libros_categorias WHERE id_libro=:id";
        $stmt = $daoLibro->getConexion()->prepare($sql);
        $stmt->execute(['id'=>$l['id_libro']]);
        $libCat = $stmt->fetchAll(PDO::FETCH_COLUMN);
        if(!array_intersect($filtroCategorias, $libCat)) continue;
    }

    // Filtro de disponibilidad
    if($filtroDisponible !== '' && $l['disponible'] != $filtroDisponible) continue;

    $filtrados[] = $l;
}

// Eliminar libro
if(isset($_GET['eliminar'])){
    $daoLibro->eliminarRCMH($_GET['eliminar']);
    header("Location:listarLibrosRCMH.php");
}

// Comprar libro
if(isset($_GET['comprar'])){
    $daoLibro->comprarRCMH($_GET['comprar']);
    header("Location:listarLibrosRCMH.php");
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Lista de Libros</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="p-4">
<div class="container">
<h2>Lista de Libros</h2>

<!-- FORMULARIO DE FILTROS -->
<form method="GET" class="mb-3">
<div class="row g-2">
    <div class="col-md-4">
        <input type="text" name="buscar" class="form-control" placeholder="Buscar por título o autor" value="<?= htmlspecialchars($busqueda) ?>">
    </div>
    <div class="col-md-4">
        <label>Categorías:</label><br>
        <?php foreach($categorias as $c){ ?>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" name="categoria[]" value="<?= $c['id_categoria'] ?>"
                <?= in_array($c['id_categoria'],$filtroCategorias ?? [])?'checked':'' ?>>
                <label class="form-check-label"><?= $c['nombre'] ?></label>
            </div>
        <?php } ?>
    </div>
    <div class="col-md-2">
        <label>Disponibilidad:</label>
        <select name="disponible" class="form-control">
            <option value="">Todos</option>
            <option value="1" <?= $filtroDisponible==='1'?'selected':'' ?>>Sí</option>
            <option value="0" <?= $filtroDisponible==='0'?'selected':'' ?>>No</option>
        </select>
    </div>
    <div class="col-md-2 d-flex align-items-end">
        <button class="btn btn-primary w-100">Filtrar</button>
    </div>
</div>
</form>

<a href="agregarLibroRCMH.php" class="btn btn-success mb-2">Agregar Libro</a>

<table class="table table-striped">
<thead>
<tr>
<th>Título</th>
<th>Autor</th>
<th>Portada</th>
<th>Stock</th>
<th>Disponible</th>
<th>Acciones</th>
</tr>
</thead>
<tbody>
<?php foreach($filtrados as $l){ ?>
<tr>
<td><?= htmlspecialchars($l['titulo']) ?></td>
<td><?= htmlspecialchars($l['autor_nombre']) ?></td>
<td><?php if($l['portada']) echo "<img src='".htmlspecialchars($l['portada'])."' width='50'>"; ?></td>
<td><?= $l['stock'] ?></td>
<td><?= $l['disponible']==1?'Sí':'No' ?></td>
<td>
<a href="editarLibroRCMH.php?id=<?= $l['id_libro'] ?>" class="btn btn-warning btn-sm">Editar</a>
<a href="?eliminar=<?= $l['id_libro'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('¿Eliminar libro?')">Eliminar</a>
<?php if($l['disponible']==1){ ?>
<a href="?comprar=<?= $l['id_libro'] ?>" class="btn btn-success btn-sm">Comprar</a>
<?php } ?>
</td>
</tr>
<?php } ?>
</tbody>
</table>
</div>
</body>
</html>
