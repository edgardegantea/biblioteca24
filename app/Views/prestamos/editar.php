<?= $this->extend('layout/main'); ?>
<?= $this->section('content'); ?>

    <h1>Editar Préstamo</h1>

<?php if (session()->getFlashdata('errors')) : ?>
    <div class="alert alert-danger">
        <ul>
            <?php foreach (session()->getFlashdata('errors') as $error) : ?>
                <li><?= $error ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>

    <form action="/admin/prestamos/actualizar/<?= $prestamo['id_prestamo'] ?>" method="post">
        <div class="form-group">
            <label for="id_usuario">Usuario:</label>
            <select name="id_usuario" id="id_usuario" class="form-control select2" data-placeholder="Selecciona un usuario">
                <?php foreach ($usuarios as $usuario) : ?>
                    <option value="<?= $usuario['id'] ?>" <?= ($usuario['id'] == $prestamo['id_usuario']) ? 'selected' : '' ?>><?= $usuario['nombre'] ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="form-group">
            <label for="fecha_prestamo">Fecha de Préstamo:</label>
            <input type="date" name="fecha_prestamo" id="fecha_prestamo" class="form-control" value="<?= $prestamo['fecha_prestamo'] ?>">
        </div>
        <div class="form-group">
            <label for="fecha_devolucion">Fecha de Devolución:</label>
            <input type="date" name="fecha_devolucion" id="fecha_devolucion" class="form-control" value="<?= $prestamo['fecha_devolucion'] ?>">
        </div>
        <div class="form-group">
            <label for="estado">Estado:</label>
            <select name="estado" id="estado" class="form-control">
                <option value="solicitado" <?= ($prestamo['estado'] == 'solicitado') ? 'selected' : '' ?>>Solicitado</option>
                <option value="aprobado" <?= ($prestamo['estado'] == 'aprobado') ? 'selected' : '' ?>>Aprobado</option>
                <option value="rechazado" <?= ($prestamo['estado'] == 'rechazado') ? 'selected' : '' ?>>Rechazado</option>
                <option value="en curso" <?= ($prestamo['estado'] == 'en curso') ? 'selected' : '' ?>>En curso</option>
                <option value="finalizado" <?= ($prestamo['estado'] == 'finalizado') ? 'selected' : '' ?>>Finalizado</option>
            </select>
        </div>
        <div class="form-group">
            <label for="observaciones">Observaciones:</label>
            <textarea name="observaciones" id="observaciones" class="form-control"><?= $prestamo['observaciones'] ?></textarea>
        </div>

        <h2>Recursos</h2>
        <div id="recursos-container">
            <?php foreach ($detalles as $detalle) : ?>
                <div class="form-group">
                    <label for="recursos[]">Recurso:</label>
                    <select name="recursos[]" class="form-control select2" data-placeholder="Selecciona un recurso">
                        <?php foreach ($recursos as $recurso) : ?>
                            <option value="<?= $recurso['id'] ?>" <?= ($recurso['id'] == $detalle['id_recurso']) ? 'selected' : '' ?>><?= $recurso['titulo'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            <?php endforeach; ?>
        </div>
        <button type="button" class="btn btn-secondary" onclick="agregarRecurso()">Agregar Recurso</button>

        <button type="submit" class="btn btn-primary">Actualizar</button>
    </form>

    <script>
        function agregarRecurso() {
            var container = document.getElementById('recursos-container');
            var newSelect = document.createElement('div');
            newSelect.className = 'form-group';
            newSelect.innerHTML = `
            <label for="recursos[]">Recurso:</label>
            <select name="recursos[]" class="form-control select2" data-placeholder="Selecciona un recurso">
                <?php foreach ($recursos as $recurso) : ?>
                    <option value="<?= $recurso['id'] ?>"><?= $recurso['titulo'] ?></option>
                <?php endforeach; ?>
            </select>
        `;
            container.appendChild(newSelect);

            $(newSelect).find('.select2').select2();
        }

        $(document).ready(function() {
            $('.select2').select2();
        });
    </script>

<?= $this->endSection(); ?>