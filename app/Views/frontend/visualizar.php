<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>
<?= $this->extend('frontend/layout/main'); ?>
<?= $this->section('content'); ?>

<div class="">

    <div class="row">
        <div class="col-md-8">
            <h3><?= $archivo['nombre'] ?></h3>
        </div>
        <div class="col-md-4">
            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                <a href="<?= base_url('admin/archivos'); ?>" class="btn btn-primary">Volver</a>
            </div>
        </div>

    </div>


    <div id="pdf-viewer"></div>


</div>

<script>
    window.onload = function() {
        PDFObject.embed("<?= base_url($archivo['ruta']) ?>", "#pdf-viewer");
    };
</script>


<?= $this->endSection(); ?>