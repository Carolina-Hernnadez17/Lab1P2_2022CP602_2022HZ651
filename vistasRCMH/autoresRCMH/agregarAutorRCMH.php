<div class="card">
    <div class="card-header">Agregar Autor</div>
    <div class="card-body">
        <?php if(isset($error)) echo "<div class='alert alert-danger'>$error</div>"; ?>
        <form method="post">
            <div class="mb-3">
                <label>Nombre</label>
                <input type="text" name="nombre" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Nacionalidad</label>
                <input type="text" name="nacionalidad" class="form-control" required>
            </div>
            <button class="btn btn-primary">Agregar</button>
        </form>
    </div>
</div>
