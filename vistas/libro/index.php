<h2>Libros</h2>
<a href="<?= RUTA; ?>libro/add" class="btn btn-success mb-3">Agregar Libro</a>

<form method="GET" class="mb-3">
    <input type="text" name="q" placeholder="Buscar libro..." class="form-control" style="max-width: 300px; display:inline-block;">
    <button type="submit" class="btn btn-primary">Buscar</button>
</form>

<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>ID</th>
            <th>Título</th>
            <th>Autor</th>
            <th>Categorías</th>
            <th>Disponible</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
    <?php if(!empty($libros)): ?>
        <?php foreach($libros as $libro): ?>
        <tr>
            <td><?= $libro->getId(); ?></td>
            <td><?= $libro->getTitulo(); ?></td>
            <td><?= $libro->getIdAutor(); ?></td>
            <td>
                <?php 
                $cats = $lcDAO->getCategoriasByLibro($libro->getId());
                foreach($cats as $c) { echo $c['nombre']." "; } 
                ?>
            </td>
            <td><?= $libro->getDisponible() ? "Sí" : "No"; ?></td>
            <td>
                <a href="<?= RUTA; ?>libro/edit/<?= $libro->getId(); ?>" class="btn btn-warning btn-sm">Editar</a>
                <a href="<?= RUTA; ?>libro/delete/<?= $libro->getId(); ?>" class="btn btn-danger btn-sm" onclick="return confirm('¿Seguro?')">Eliminar</a>
            </td>
        </tr>
        <?php endforeach; ?>
    <?php else: ?>
        <tr><td colspan="6">No hay libros.</td></tr>
    <?php endif; ?>
    </tbody>
</table>
