<?= $this->extend('layout/main'); ?>

<?= $this->section('content'); ?>

    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">

    <div class="card mt-3">
        <div class="card-header">
            <div class="">
                <div class="row">
                    <div class="col-md-8">
                        <h2>Publicaciones</h2>
                    </div>
                    <div class="col-md-4">
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <a href="<?= base_url('admin/carousel/create'); ?>" class="btn btn-primary">Nueva
                                publicación</a>
                        </div>
                    </div>

                </div>

            </div>

        </div>

        <div class="card-body">


            <table id="carouselTable" class="table table-striped" style="width:100%">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Archivo andjunto</th>
                    <th>Tipo</th>
                    <th>Titulo</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($carouselItems as $item): ?>
                    <tr>
                        <td><?= $item['id'] ?></td>
                        <td>
                            <a href="<?= base_url('uploads/' . $item['filename']); ?>" target="_blank">
                                <img src="<?= base_url('uploads/' . $item['filename']); ?>"
                                     alt="<?= $item['filename']; ?>"
                                     style="width: 100px;">
                            </a>
                        </td>
                        <td><?= $item['tipo'] ?></td>
                        <td><?= $item['titulo'] ?></td>
                        <td><?= $item['estado'] ?></td>
                        <td>
                            <!-- <a href="/admin/carousel/edit/<?= $item['id'] ?>"><i class="bi bi-pencil-square"></i></a> -->
                            <a href="/admin/carousel/delete/<?= $item['id'] ?>"
                               class="border-0 bg-transparent text-danger"
                               onclick="return confirm('¿Desea eliminar el elemento seleccionado?')"><i
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