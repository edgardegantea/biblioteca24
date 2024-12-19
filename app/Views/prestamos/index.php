<?= $this->extend('layout/main'); ?>
<?= $this->section('content'); ?>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">



<?php if (session()->getFlashdata('success')) : ?>
    <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
<?php endif; ?>

<?php if (session()->getFlashdata('error')) : ?>
    <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
<?php endif; ?>


<div class="card mt-5">

    <div class="card-header">

    <div class="row mt-3">
        <div class="col-md-8">
            <h2>Préstamos</h2>
        </div>
        <div class="col-md-4">
            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                <a href="<?= base_url('admin/prestamos/crear') ?>" class="btn btn-primary mb-3">Nuevo préstamo</a>
            </div>
        </div>
    </div>
    </div>

<div class="card-body">
    <table id="prestamosTable" class="table table-striped table-bordered">
        <thead>
        <tr>
            <th>ID</th>
            <th>Usuario</th>
            <th>Fecha Préstamo</th>
            <th>Fecha Devolución</th>
            <th>Estado</th>
            <th>Recursos</th>
            <th>Acciones</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($prestamos as $prestamo) : ?>
            <tr>
                <td><?= $prestamo['id_prestamo'] ?></td>
                <td><?= $prestamo['nombre_usuario'] ?></td>
                <td><?= $prestamo['fecha_prestamo'] ?></td>
                <td><?= $prestamo['fecha_devolucion'] ?></td>
                <td><?= $prestamo['estado'] ?></td>
                <td>
                    <ul>
                        <?php foreach ($prestamo['detalles'] as $detalle) : ?>
                            <li><?= $detalle['nombre_recurso'] ?></li>
                        <?php endforeach; ?>
                    </ul>
                </td>
                <td>
                    <a href="/admin/prestamos/ver/<?= $prestamo['id_prestamo'] ?>" class="btn btn-warning">Ver</a>
                    <a href="/admin/prestamos/editar/<?= $prestamo['id_prestamo'] ?>" class="btn btn-warning">Editar</a>
                    <a href="/admin/prestamos/eliminar/<?= $prestamo['id_prestamo'] ?>" class="btn btn-danger">Eliminar</a>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>
</div>




    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>

    <script>
        $(document).ready(function () {
            // Inicializar DataTables en la tabla de usuarios
            $('#prestamosTable').DataTable({
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.10.21/i18n/Spanish.json"
                }
            });

            setTimeout(function () {
                $('.alert-success').fadeOut('slow');
            }, 5000);
        });
    </script>

<?= $this->endSection(); ?>