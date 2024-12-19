<?= $this->extend('layout/main'); ?>
<?= $this->section('content'); ?>

    <h1>Nuevo Préstamo</h1>

<?php if (session()->getFlashdata('errors')) : ?>
    <div class="alert alert-danger">
        <ul>
            <?php foreach (session()->getFlashdata('errors') as $error) : ?>
                <li><?= $error ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>

    <form action="/admin/prestamos/guardar" method="post">
        <div class="form-group">
            <label for="id_usuario">Usuario:</label>
            <select name="id_usuario" id="id_usuario" class="form-control select2" data-placeholder="Selecciona un usuario">
                <?php foreach ($usuarios as $usuario) : ?>
                    <option value="<?= $usuario['id'] ?>"><?= $usuario['nombre'] ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="form-group">
            <label for="fecha_prestamo">Fecha de Préstamo:</label>
            <input type="date" name="fecha_prestamo" id="fecha_prestamo" class="form-control" value="<?= old('fecha_prestamo') ?>">
        </div>
        <div class="form-group">
            <label for="fecha_devolucion">Fecha de Devolución:</label>
            <input type="date" name="fecha_devolucion" id="fecha_devolucion" class="form-control" value="<?= old('fecha_devolucion') ?>">
        </div>
        <div class="form-group">
            <label for="observaciones">Observaciones:</label>
            <textarea name="observaciones" id="observaciones" class="form-control"><?= old('observaciones') ?></textarea>
        </div>

        <h2>Recursos</h2>

        <table id="recursos-table" class="table table-striped table-bordered">
            <thead>
            <tr>
                <th></th>
                <th>Título</th>
                <th>Autor</th>
                <th>Cantidad</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($recursos as $recurso) : ?>
                <tr>
                    <td></td>
                    <td><?= $recurso['titulo'] ?></td>
                    <td>
                        <?php
                        $autores = $recursoModel->obtenerAutoresRecurso($recurso['id']);
                        echo implode(', ', array_column($autores, 'nombre'));
                        ?>
                    </td>
                    <td><?= $recurso['numero_ejemplares'] ?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>

        <input type="hidden" name="recursos" id="recursos-seleccionados">

        <button type="submit" class="btn btn-primary">Guardar</button>
    </form>


    <script>
        $(document).ready(function() {
            var table = $('#recursos-table').DataTable({
                language: {
                    url: "//cdn.datatables.net/plug-ins/1.10.25/i18n/Spanish.json"
                },
                columnDefs: [
                    {
                        targets: 0,
                        searchable: false,
                        orderable: false,
                        className: 'dt-body-center',
                        render: function (data, type, full, meta) {
                            return '<input type="checkbox" name="recursos_id[]" value="' + full.id + '">';
                        }
                    }
                ],
                select: {
                    style: 'multi'
                }
            });

            $('form').on('submit', function(e) {
                var recursosSeleccionados = [];
                table.rows({ selected: true }).data().each(function(row) {
                    recursosSeleccionados.push(row.id);
                });
                $('#recursos-seleccionados').val(recursosSeleccionados.join(','));
            });
        });
    </script>

<?= $this->endSection(); ?>