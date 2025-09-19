<h2>Editar Autor</h2>
<?php if(isset($error)): ?>
<div class="alert alert-danger"><?= $error; ?></div>
<?php endif; ?>

<form method="POST">
    <div class="mb-3">
        <label for="nombre" class="form-label">Nombre</label>
        <input type="text" class="form-control" id="nombre" name="nombre" value="<?= htmlspecialchars($autor->getNombre()); ?>" required>
    </div>
    <div class="mb-3">
        <label for="nacionalidad" class="form-label">Nacionalidad</label>
        <input type="text" class="form-control" id="nacionalidad" name="nacionalidad" value="<?= htmlspecialchars($autor->getNacionalidad()); ?>" required>
    </div>
    <button type="submit" class="btn btn-primary">Actualizar</button>
    <a href="<?= RUTA; ?>autores" class="btn btn-secondary">Cancelar</a>
</form>
