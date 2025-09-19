<h2>Autores</h2>
<a href="<?= RUTA; ?>autor/add" class="btn btn-success mb-3">Agregar Autor</a>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Nacionalidad</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php if(!empty($autores)): ?>
            <?php foreach($autores as $a): ?>
                <tr>
                    <td><?= $a->getId(); ?></td>
                    <td><?= $a->getNombre(); ?></td>
                    <td><?= $a->getNacionalidad(); ?></td>
                    <td>
                        <a href="<?= RUTA; ?>autor/edit/<?= $a->getId(); ?>" class="btn btn-primary btn-sm">Editar</a>
                        <a href="<?= RUTA; ?>autor/delete/<?= $a->getId(); ?>" class="btn btn-danger btn-sm"
                           onclick="return confirm('¿Seguro que desea eliminar este autor?');">Eliminar</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr><td colspan="4">No hay autores</td></tr>
        <?php endif; ?>
    </tbody>
</table>
