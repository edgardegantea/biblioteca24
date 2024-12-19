<?= $this->extend('layout/main'); ?>


<?= $this->section('content'); ?>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">

    <div class="container mt-5">
        <h1>Publicaciones</h1>

        <a href="/admin/publicaciones/new" class="btn btn-primary mb-3">Crear Nueva Publicación</a>

        <table id="publicacionesTable" class="table table-striped" style="width:100%">
            <thead>
            <tr>
                <th>Título</th>
                <th>Fecha Publicación</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($publicaciones as $publicacion): ?>
                <tr>
                    <td><?= $publicacion['titulo'] ?></td>
                    <td><?= $publicacion['fecha_publicacion'] ?></td>
                    <td><?= $publicacion['estado'] ?></td>
                    <td>
                        <a href="/publicaciones/edit/<?= $publicacion['id'] ?>"
                           class="btn btn-sm btn-warning">Editar</a>
                        <a href="/publicaciones/delete/<?= $publicacion['id'] ?>" class="btn btn-sm btn-danger"
                           onclick="return confirm('¿Estás seguro de eliminar esta publicación?')">Eliminar</a>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>


    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>

    <script>
        $(document).ready(function () {

            $('#publicacionesTable').DataTable({
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