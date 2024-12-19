<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>

    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfobject/2.2.11/pdfobject.min.js"></script>  


<?php if (session()->getFlashdata('success')): ?>
    <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
<?php endif; ?>

    <div class="card">
        <div class="card-header">

            <div class="row">
                <div class="col-md-8">
                    <h2>Recursos digitales</h2>
                </div>
                <div class="col-md-4">
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">

                        <a href="<?= base_url('admin/archivos/create') ?>" class="btn btn-primary">Subir recurso (s)</a>
                    </div>
                </div>

            </div>

        </div>

        <div class="card-body">


            <table id="archivosTable" class="table table-striped" style="width:100%">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Clasificación</th>
                    <th>Tamaño</th>
                    <!-- <th>Tipo</th> -->
                    <th>Acciones</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($archivos as $archivo): ?>
                    <tr>
                        <td><?= $archivo['id'] ?></td>
                        <td>
                            <?php if ($archivo['tipo'] === 'application/pdf'): ?>
                                <a href="/admin/archivos/show/<?= $archivo['id'] ?>" class="text-decoration-none"
                                   target="_self"><?= $archivo['nombre'] ?></a>
                            <?php endif; ?>
                        </td>
                        <td><?= $archivo['clasificacion_nombre'] ?></td>
                        <td><?= number_format($archivo['peso'] / 1024, 2) ?> KB</td>
                        <!-- <td><?= $archivo['tipo'] ?></td> -->
                        <td>
                            <!--
                    <?php if ($archivo['tipo'] === 'application/pdf'): ?>
                        <a href="/admin/archivos/visualizar/<?= $archivo['id'] ?>" class="btn btn-info btn-sm" target="_self">Ver</a>
                    <?php endif; ?>
                    -->
                            <a href="/admin/archivos/edit/<?= $archivo['id'] ?>" class="btn btn-light btn-sm"><i
                                        class="bi bi-pencil-square"></i></a>
                            <a href="/admin/archivos/delete/<?= $archivo['id'] ?>"
                               class="btn btn-light btn-sm border-0 text-danger"
                               onclick="return confirm('¿Estás seguro de eliminar este archivo?')"><i
                                        class="bi bi-x-square"></i></a>
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
            $('#archivosTable').DataTable({
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
