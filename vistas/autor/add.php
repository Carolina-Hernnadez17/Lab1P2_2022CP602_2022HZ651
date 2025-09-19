<h2>Agregar Autor</h2>
<a href="<?= RUTA; ?>autor" class="btn btn-secondary mb-3">Volver</a>

<?php if(isset($error)): ?>
<div class="alert alert-danger"><?= $error; ?></div>
<?php endif; ?>

<form action="" method="post">
    <div class="mb-3">
        <label>Nombre</label>
        <input type="text" name="nombre" class="form-control" required>
    </div>
    <div class="mb-3">
        <label>Nacionalidad</label>
        <input type="text" name="nacionalidad" class="form-control">
    </div>
    <button type="submit" class="btn btn-success">Guardar</button>
</form>
