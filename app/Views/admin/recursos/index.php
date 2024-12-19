<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>

<!-- Incluir CSS de DataTables -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">

<div class="mt-3">
    <div class="row">
        <div class="col-md-8">
            <h2>Recursos bibliográficos</h2>
        </div>
        <div class="col-md-4">
            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                <a class="btn btn-primary" href="<?= base_url('admin/recursos/step1') ?>">Registrar recurso</a>
            </div>
        </div>
    </div>

    <?php if (session()->has('success')): ?>
        <div id="success-message" class="alert alert-success">
            <?= session('success') ?>
        </div>
    <?php endif; ?>

    <?php if (session()->has('error')): ?>
        <div id="error-message" class="alert alert-danger">
            <?= session('error') ?>
        </div>
    <?php endif; ?>

    <table id="recursosTable" class="display table table-striped table-hover mt-3" style="width:100%">
        <thead>
        <tr>
            <th>Título</th>
            <th>Acciones</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($recursos as $recurso): ?>
            <tr>
                <td>
                    <a href="<?= base_url('admin/recursos/show/' . $recurso['id']) ?>" class="text-decoration-none">
                        <?= esc($recurso['titulo']) ?>
                    </a><br>
                    <?= esc($recurso['genero_nombre']) ?> - <?= esc($recurso['isbn']) ?> - <?= esc($recurso['editorial_nombre']) ?> - <?= esc($recurso['anio_publicacion']) ?>
                </td>
                <td>
                    <!-- Botón de Eliminar -->
                    <form action="/admin/recursos/delete/<?= $recurso['id'] ?>" method="post" style="display: inline;">
                        <?= csrf_field() ?>
                        <input type="hidden" name="_method" value="DELETE">
                        <button type="submit" class="btn btn-outline-danger btn-sm"><i class="bi bi-trash"></i> Eliminar</button>
                    </form>

                    <!-- Botón de Generar Referencia APA usando ISBN -->
                    <?php if (!empty($recurso['isbn'])): ?>
                        <button type="button" class="btn btn-outline-secondary btn-sm mt-1" onclick="generarReferenciaAPA('<?= esc($recurso['isbn']) ?>')">
                            Generar Referencia APA
                        </button>
                    <?php else: ?>
                        <button type="button" class="btn btn-secondary btn-sm mt-1" disabled>ISBN no disponible</button>
                    <?php endif; ?>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>

<!-- Incluir JS de jQuery y DataTables -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>

<script>
    $(document).ready(function () {
        $('#recursosTable').DataTable({
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.21/i18n/Spanish.json"
            }
        });

        // Ocultar automáticamente el mensaje de éxito/error después de 5 segundos
        setTimeout(function () {
            $('#success-message').fadeOut('slow');
            $('#error-message').fadeOut('slow');
        }, 5000);
    });

    // Función para generar la referencia en APA usando el ISBN
    function generarReferenciaAPA(isbn) {
        // URL de la API de Open Library para buscar por ISBN
        const url = `https://openlibrary.org/api/books?bibkeys=ISBN:${isbn}&jscmd=data&format=json`;

        // Realizar la solicitud AJAX
        fetch(url)
            .then(response => response.json())
            .then(data => {
                const bookData = data[`ISBN:${isbn}`];

                if (bookData) {
                    const titulo = bookData.title;
                    const anio = bookData.publish_date ? bookData.publish_date.split(" ")[0] : "s.f.";
                    const editorial = bookData.publishers ? bookData.publishers[0].name : "s.n.";
                    const autores = bookData.authors ? bookData.authors.map(author => author.name).join(", ") : "Autor desconocido";

                    // Construir la referencia en formato APA
                    const referenciaAPA = `${autores} (${anio}). ${titulo}. ${editorial}.`;

                    // Mostrar la referencia en un alert (puedes usar un modal si prefieres)
                    alert('Referencia APA:\n\n' + referenciaAPA);
                } else {
                    alert('No se encontró información para el ISBN proporcionado.');
                }
            })
            .catch(error => {
                console.error('Error al obtener la información del libro:', error);
                alert('Hubo un error al generar la referencia. Intente de nuevo.');
            });
    }
</script>

<?= $this->endSection() ?>
