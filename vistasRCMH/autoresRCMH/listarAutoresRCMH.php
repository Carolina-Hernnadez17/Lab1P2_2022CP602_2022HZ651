<?php
require_once "../../controladoresRCMH/AutorControladorRCMH.php";

$controlador = new AutorControladorRCMH();
$dao = $controlador->getDao();
$autores = $dao->listarRCMH();

// Capturar filtros
$busqueda = $_GET['buscar'] ?? '';
$filtroNacionalidad = $_GET['nacionalidad'] ?? '';

// Filtrar autores
$filtrados = [];
foreach($autores as $a){
    if($busqueda && stripos($a['nombre'], $busqueda)===false){
        continue;
    }
    if($filtroNacionalidad && $a['nacionalidad'] != $filtroNacionalidad){
        continue;
    }
    $filtrados[] = $a;
}

// Eliminar autor
if(isset($_GET['eliminar'])){
    $dao->eliminarRCMH($_GET['eliminar']);
    header("Location:listarAutoresRCMH.php");
}

// Obtener todas las nacionalidades para el filtro
$nacionalidades = array_unique(array_map(fn($x)=>$x['nacionalidad'], $autores));
sort($nacionalidades);
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Lista de Autores</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="p-4">
<div class="container">
<h2>Lista de Autores</h2>

<!-- FORMULARIO DE FILTROS -->
<form method="GET" class="mb-3">
<div class="row g-2">
    <div class="col-md-6">
        <input type="text" name="buscar" class="form-control" placeholder="Buscar por nombre" value="<?= htmlspecialchars($busqueda) ?>">
    </div>
    <div class="col-md-4">
        <label>Nacionalidad:</label><br>
        <?php foreach($nacionalidades as $n){ ?>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="nacionalidad" value="<?= htmlspecialchars($n) ?>"
                <?= $filtroNacionalidad==$n?'checked':'' ?>>
                <label class="form-check-label"><?= htmlspecialchars($n) ?></label>
            </div>
        <?php } ?>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="nacionalidad" value="" <?= $filtroNacionalidad==''?'checked':'' ?>>
            <label class="form-check-label">Todas</label>
        </div>
    </div>
    <div class="col-md-2 d-flex align-items-end">
        <button class="btn btn-primary w-100">Filtrar</button>
    </div>
</div>
</form>

<a href="agregarAutorRCMH.php" class="btn btn-success mb-2">Agregar Autor</a>

<table class="table table-striped">
<thead>
<tr>
<th>Nombre</th>
<th>Nacionalidad</th>
<th>Acciones</th>
</tr>
</thead>
<tbody>
<?php foreach($filtrados as $a){ ?>
<tr>
<td><?= htmlspecialchars($a['nombre']) ?></td>
<td><?= htmlspecialchars($a['nacionalidad']) ?></td>
<td>
<a href="editarAutorRCMH.php?id=<?= $a['id_autor'] ?>" class="btn btn-warning btn-sm">Editar</a>
<a href="?eliminar=<?= $a['id_autor'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('¿Eliminar autor?')">Eliminar</a>
</td>
</tr>
<?php } ?>
</tbody>
</table>
</div>
</body>
</html>
