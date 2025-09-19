<h2>Categorías</h2>
<a href="<?= RUTA; ?>categoria/add" class="btn btn-success mb-3">Agregar Categoría</a>

<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php if(!empty($categorias)): ?>
            <?php foreach($categorias as $c): ?>
            <tr>
                <td><?= $c->getId(); ?></td>
                <td><?= $c->getNombre(); ?></td>
                <td>
                    <a href="<?= RUTA; ?>categoria/edit/<?= $c->getId(); ?>" class="btn btn-warning btn-sm">Editar</a>
                    <a href="<?= RUTA; ?>categoria/delete/<?= $c->getId(); ?>" class="btn btn-danger btn-sm" onclick="return confirm('¿Seguro?')">Eliminar</a>
                </td>
            </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr><td colspan="3">No hay categorías.</td></tr>
        <?php endif; ?>
    </tbody>
</table>
