<h2>Agregar Libro</h2>
<a href="<?= RUTA; ?>libros" class="btn btn-secondary mb-3">Volver</a>

<?php if(isset($error)): ?>
<div class="alert alert-danger"><?= $error; ?></div>
<?php endif; ?>

<form action="" method="post" enctype="multipart/form-data">
    <div class="mb-3">
        <label>Título</label>
        <input type="text" name="titulo" class="form-control" required>
    </div>
    <div class="mb-3">
        <label>Autor</label>
        <select name="id_autor" class="form-control" required>
            <option value="">-- Seleccionar --</option>
            <?php foreach($autores as $a): ?>
                <option value="<?= $a->getId(); ?>"><?= $a->getNombre(); ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="mb-3">
        <label>Categorías</label><br>
        <?php if(!empty($categorias)): ?>
            <?php foreach($categorias as $c): ?>
                <input type="checkbox" name="categorias[]" value="<?= $c->getId(); ?>"> <?= $c->getNombre(); ?><br>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
    <div class="mb-3">
        <label>Portada</label>
        <input type="file" name="portada" class="form-control">
    </div>
    <div class="mb-3">
        <label>Disponible</label>
        <select name="disponible" class="form-control">
            <option value="1">Sí</option>
            <option value="0">No</option>
        </select>
    </div>
    <button type="submit" class="btn btn-success">Guardar</button>
</form>
