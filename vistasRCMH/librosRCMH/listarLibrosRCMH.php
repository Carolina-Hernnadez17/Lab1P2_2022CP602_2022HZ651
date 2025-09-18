<h2>Lista de Libros</h2>
<a href="<?= RUTA; ?>libro/agregar" class="btn btn-success mb-2">Agregar Libro</a>
<table class="table table-bordered">
    <thead>
        <tr>
            <th>Portada</th>
            <th>Título</th>
            <th>Autor</th>
            <th>Stock</th>
            <th>Disponible</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($libros as $libro): ?>
        <tr>
            <td><img src="<?= $libro['portada']; ?>" width="50"></td>
            <td><?= $libro['titulo']; ?></td>
            <td><?= $libro['autor']; ?></td>
            <td><?= $libro['stock']; ?></td>
            <td><?= $libro['disponible'] ? 'Sí' : 'No'; ?></td>
            <td>
                <?php if($libro['disponible']): ?>
                    <a href="<?= RUTA; ?>libro/comprar/<?= $libro['id_libro']; ?>" class="btn btn-success btn-sm">Comprar</a>
                <?php endif; ?>
                <a href="<?= RUTA; ?>libro/eliminar/<?= $libro['id_libro']; ?>" class="btn btn-danger btn-sm">Eliminar</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
