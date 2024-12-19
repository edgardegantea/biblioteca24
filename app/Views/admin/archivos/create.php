<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>

<!-- Incluir CSS y JS de Select2 y PDF.js -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.10.377/pdf.min.js"></script>

<div class="container mt-4">
    <h2>Subir Nuevo Archivo</h2>

    <?php if (isset($errors)): ?>
        <div class="alert alert-danger">
            <?php foreach ($errors as $error): ?>
                <p><?= esc($error) ?></p>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <form id="uploadForm" action="<?= base_url('admin/archivos/store') ?>" method="post" enctype="multipart/form-data" class="form">
        <div class="mb-3">
            <label for="archivos" class="form-label">Archivo(s):</label>
            <input type="file" name="archivos[]" id="archivos" multiple class="form-control">
            <div id="file-previews" class="mt-3 d-flex flex-wrap"></div>
        </div>

        <div class="mb-3">
            <label for="clasificacion_id" class="form-label">Clasificación:</label>
            <select name="clasificacion_id" id="clasificacion_id" class="form-select">
                <option value="" disabled selected>Selecciona una clasificación</option>
                <?php foreach ($clasificaciones as $clasificacion): ?>
                    <option value="<?= $clasificacion['id'] ?>"><?= esc($clasificacion['nombre']) ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Subir</button>
    </form>
</div>

<script>
    $(document).ready(function() {
        $('#clasificacion_id').select2({
            placeholder: "Selecciona una clasificación",
            allowClear: true,
            width: '100%'
        });

        let fileInput = $('#archivos');
        let filePreviews = $('#file-previews');

        fileInput.on('change', function() {
            filePreviews.empty(); // Limpiar previas anteriores
            let files = fileInput[0].files;

            for (let i = 0; i < files.length; i++) {
                if (files[i].type === 'application/pdf') {
                    generateThumbnail(files[i]);
                }
            }
        });

        function generateThumbnail(file) {
            let reader = new FileReader();
            reader.onload = function(e) {
                let pdfData = e.target.result;

                pdfjsLib.getDocument({ data: pdfData }).promise.then(function(pdf) {
                    pdf.getPage(1).then(function(page) {
                        let scale = 0.5;
                        let viewport = page.getViewport({ scale: scale });
                        let canvas = document.createElement('canvas');
                        canvas.width = viewport.width;
                        canvas.height = viewport.height;

                        let context = canvas.getContext('2d');
                        page.render({
                            canvasContext: context,
                            viewport: viewport
                        }).promise.then(function() {
                            let img = document.createElement('img');
                            img.src = canvas.toDataURL();
                            img.className = 'img-thumbnail m-2';
                            img.style.width = '100px';
                            filePreviews.append(img);
                        });
                    });
                });
            };
            reader.readAsArrayBuffer(file);
        }
    });
</script>

<?= $this->endSection(); ?>
