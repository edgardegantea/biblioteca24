<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>

<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col-md-8">
                <p class="text-primary"><?= esc($archivo['nombre']) ?></p>
            </div>
            <div class="col-md-4">
                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <a href="<?= base_url('admin/archivos') ?>" class="btn btn-outline-primary"><< Regresar a Archivos</a>
                </div>
            </div>
        </div>
    </div>

    <div class="card-body">
        <iframe src="<?= $rutaArchivo ?>#toolbar=0&navpanes=0&scrollbar=0" width="100%" height="600px" readonly></iframe>
    </div>
</div>

<?= $this->endSection(); ?>
