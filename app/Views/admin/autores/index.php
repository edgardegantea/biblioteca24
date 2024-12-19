<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">

<?php if (session()->has('success')): ?>
    <div class="alert alert-success"><?= session('success') ?></div>
<?php endif; ?>

<?php if (session()->has('error')): ?>
    <div class="alert alert-danger"><?= session('error') ?></div>
<?php endif; ?>


    <div class="card mt-5">

        <div class="card-header">
            <div class="row mt-3">
                <div class="col-md-8">
                    <h2>Autores</h2>
                </div>
                <div class="col-md-4">
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <a href="<?= base_url('admin/autores/new'); ?>" class="btn btn-primary">Nuevo autor</a>
                    </div>
                </div>
            </div>

        </div>

        <div class="card-body">


            <table id="autoresTable" class="table table-striped" style="width:100%">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($autores as $autor): ?>
                    <tr>
                        <td><?= $autor['id'] ?></td>
                        <td><?= $autor['nombre'] ?></td>
                        <td><?= $autor['estado'] ? 'Activo' : 'Inactivo' ?></td>
                        <td>
                            <a href="/admin/autores/<?= $autor['id'] ?>" class="btn btn-info btn-sm">Ver</a>
                            <a href="<?= 'autores/' . $autor['id'] . '/edit' ?>"
                               class="btn btn-warning btn-sm">Editar</a>
                            <form action="/admin/autores/<?= $autor['id'] ?>" method="post" class="d-inline">
                                <?= csrf_field() ?>
                                <input type="hidden" name="_method" value="DELETE">
                                <button type="submit" class="btn btn-danger btn-sm"
                                        onclick="return confirm('¿Estás seguro?')">Eliminar
                                </button>
                            </form>
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

            $('#autoresTable').DataTable({
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.10.21/i18n/Spanish.json"
                }
            });

            setTimeout(function () {
                $('.alert-success').fadeOut('slow');
            }, 5000);
        });
    </script>

<?= $this->endSection() ?>