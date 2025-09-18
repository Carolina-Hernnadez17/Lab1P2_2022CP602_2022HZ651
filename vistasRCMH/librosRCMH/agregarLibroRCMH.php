<div class="card">
    <div class="card-header">Agregar Libro</div>
    <div class="card-body">
        <?php if(isset($error)) echo "<div class='alert alert-danger'>$error</div>"; ?>
        <form method="post">
            <div class="mb-3">
                <label>Título</label>
                <input type="text" name="titulo" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Autor</label>
                <select name="idAutor" class="form-select" required>
                    <option value="">Seleccione</option>
                    <?php foreach($autores as $autor): ?>
                        <option value="<?= $autor['id_autor']; ?>"><?= $autor['nombre']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="mb-3">
                <label>Portada (URL)</label>
                <input type="url" name="portada" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Stock</label>
                <input type="number" name="stock" class="form-control" value="1" min="1" required>
            </div>
            <button class="btn btn-primary">Agregar Libro</button>
        </form>
    </div>
</div>
