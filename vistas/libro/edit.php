<h2>Editar Libro</h2>
<a href="<?= RUTA; ?>libro" class="btn btn-secondary mb-3">Volver</a>

<?php if(isset($error)): ?>
<div class="alert alert-danger"><?= $error; ?></div>
<?php endif; ?>

<form action="" method="post" enctype="multipart/form-data">
    <div class="mb-3">
        <label>Título</label>
        <input type="text" name="titulo" class="form-control" value="<?= $libro->getTitulo(); ?>" required>
    </div>
    <div class="mb-3">
        <label>Autor</label>
        <select name="id_autor" class="form-control" required>
            <?php foreach($autores as $a): ?>
            <option value="<?= $a->getId(); ?>" <?= $a->getId() == $libro->getIdAutor() ? "selected" : ""; ?>>
                <?= $a->getNombre(); ?>
            </option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="mb-3">
        <label>Categorías</label><br>
        <?php 
        $libroCats = array_column($lcDAO->getCategoriasByLibro($libro->getId()), 'id_categoria');
        foreach($categorias as $c): 
        ?>
        <input type="checkbox" name="categorias[]" value="<?= $c->getId(); ?>" <?= in_array($c->getId(), $libroCats) ? "checked" : ""; ?>>
        <?= $c->getNombre(); ?><br>
        <?php endforeach; ?>
    </div>
    <div class="mb-3">
        <label>Portada</label>
        <input type="file" name="portada" class="form-control">
        <?php if($libro->getPortada()): ?>
        <small>Portada actual: <?= $libro->getPortada(); ?></small>
        <?php endif; ?>
    </div>
    <div class="mb-3">
        <label>Disponible</label>
        <select name="disponible" class="form-control">
            <option value="1" <?= $libro->getDisponible() ? "selected" : ""; ?>>Sí</option>
            <option value="0" <?= !$libro->getDisponible() ? "selected" : ""; ?>>No</option>
        </select>
    </div>
    <button type="submit" class="btn btn-success">Actualizar</button>
</form>
