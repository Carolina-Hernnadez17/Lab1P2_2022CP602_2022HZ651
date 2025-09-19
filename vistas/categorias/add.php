<h2>Agregar Categoría</h2>
<a href="<?= RUTA; ?>categoria" class="btn btn-secondary mb-3">Volver</a>

<?php if(isset($error) && $error != ""): ?>
<div class="alert alert-danger"><?= $error; ?></div>
<?php endif; ?>

<form action="" method="post">
    <div class="mb-3">
        <label>Nombre</label>
        <input type="text" name="nombre" class="form-control" required>
    </div>
    <button type="submit" class="btn btn-success">Guardar</button>
</form>
