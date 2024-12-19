<?= $this->extend('layout/main'); ?>
<?= $this->section('content'); ?>

<!-- Incluir CSS de DataTables -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">

<div class="">
    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success"><?= session()->getFlashdata('success'); ?></div>
    <?php endif; ?>

    <div class="card  mt-5">

        <div class="card-header">

            <div class="row mt-3">
                <div class="col-md-8">
                    <h2>Usuarios</h2>
                </div>
                <div class="col-md-4">
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <a href="<?= base_url('admin/usuarios/create') ?>" class="btn btn-primary mb-3">Crear
                            Usuario</a>
                    </div>
                </div>
            </div>


        </div>

        <div class="card-body">


            <table id="usuariosTable" class="table table-striped" style="width:100%">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Rol</th>
                    <th>Nombre</th>
                    <th>Email</th>
                    <th>Acciones</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($usuarios as $usuario): ?>
                    <tr>
                        <td><?= esc($usuario['id']) ?></td>
                        <td><?= esc($usuario['role']) ?></td>
                        <td><a style=""
                               class="link-underline-opacity-0 link-underline-opacity-0-hover fw-bold text-primary link-body-emphasis text-uppercase"
                               href="<?= base_url('admin/usuarios/show/' . $usuario['id']) ?>">
                                <?= esc($usuario['nombre']) ?> <?= esc($usuario['apaterno']) ?> <?= esc($usuario['amaterno']) ?></a>
                        </td>
                        <td><?= esc($usuario['email']) ?></td>
                        <td>
                            <form action="<?= base_url('admin/usuarios/delete/' . $usuario['id']) ?>" method="post"
                                  style="display:inline;">
                                <?= csrf_field() ?>
                                <input type="hidden" name="_method" value="DELETE">
                                <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
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
                // Inicializar DataTables en la tabla de usuarios
                $('#usuariosTable').DataTable({
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
