<h2>Lista de Autores</h2>
<a href="<?= RUTA; ?>autor/agregar" class="btn btn-success mb-2">Agregar Autor</a>
<table class="table table-bordered">
    <thead>
        <tr>
            <th>Nombre</th>
            <th>Nacionalidad</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($autores as $autor): ?>
        <tr>
            <td><?= $autor['nombre']; ?></td>
            <td><?= $autor['nacionalidad']; ?></td>
            <td>
                <a href="<?= RUTA; ?>autor/eliminar/<?= $autor['id_autor']; ?>" class="btn btn-danger btn-sm">Eliminar</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
