<h2>Lista de Categorías</h2>
<a href="<?= RUTA; ?>categoria/agregar" class="btn btn-success mb-2">Agregar Categoría</a>
<table class="table table-bordered">
    <thead>
        <tr>
            <th>Nombre</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($categorias as $cat): ?>
        <tr>
            <td><?= $cat['nombre']; ?></td>
            <td>
                <a href="<?= RUTA; ?>categoria/eliminar/<?= $cat['id_categoria']; ?>" class="btn btn-danger btn-sm">Eliminar</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
