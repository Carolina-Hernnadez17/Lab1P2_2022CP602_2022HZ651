<h2>Libros</h2>
<a href="<?= RUTA; ?>libro/add" class="btn btn-success mb-3">Agregar Libro</a>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>ID</th>
            <th>Título</th>
            <th>Autor</th>
            <th>Portada</th>
            <th>Disponible</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php if(!empty($libros)): ?>
            <?php foreach($libros as $l): ?>
                <tr>
                    <td><?= $l->getId(); ?></td>
                    <td><?= $l->getTitulo(); ?></td>
                    <td>
                        <?php 
                        $autor = (new AutorDAO())->getById($l->getIdAutor());
                        echo $autor ? $autor->getNombre() : "Desconocido";
                        ?>
                    </td>
                    <td>
                        <?php if($l->getPortada()): ?>
                            <img src="uploads/<?= $l->getPortada(); ?>" width="50">
                        <?php endif; ?>
                    </td>
                    <td><?= $l->getDisponible() ? "Sí" : "No"; ?></td>
                    <td>
                        <a href="<?= RUTA; ?>libro/edit/<?= $l->getId(); ?>" class="btn btn-primary btn-sm">Editar</a>
                        <a href="<?= RUTA; ?>libro/delete/<?= $l->getId(); ?>" class="btn btn-danger btn-sm"
                           onclick="return confirm('¿Seguro que desea eliminar este libro?');">Eliminar</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr><td colspan="6">No hay libros</td></tr>
        <?php endif; ?>
    </tbody>
</table>
