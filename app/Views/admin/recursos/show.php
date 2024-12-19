<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>

<h2>Detalles del Recurso Bibliográfico</h2>

<div class="card mt-4">
    <div class="card-body">
        <h3 class="card-title"><?= esc($recurso['titulo']) ?></h3>

        <?php if (!empty($recurso['subtitulo'])): ?>
            <h5 class="card-subtitle mb-2 text-muted"><?= esc($recurso['subtitulo']) ?></h5>
        <?php endif; ?>

        <p><strong>ISBN:</strong> <?= esc($recurso['isbn']) ?></p>

        <?php if (!empty($recurso['portada'])): ?>
            <div class="mb-3">
                <img src="<?= base_url('uploads/' . esc($recurso['portada'])) ?>" alt="Portada del Recurso" class="img-thumbnail" style="max-width: 200px;">
            </div>
        <?php endif; ?>

        <p><strong>Año de Publicación:</strong> <?= esc($recurso['anio_publicacion']) ?></p>
        <p><strong>Idioma:</strong> <?= esc($recurso['idioma']) ?></p>
        <p><strong>Edición:</strong> <?= esc($recurso['edicion']) ?></p>
        <p><strong>Páginas:</strong> <?= esc($recurso['paginas']) ?></p>
        <p><strong>Fecha de Publicación:</strong> <?= esc($recurso['fecha_publicacion']) ?></p>
        <p><strong>Clasificación:</strong> <?= esc($recurso['clasificacion']) ?></p>
        <p><strong>Formato:</strong> <?= esc($recurso['formato']) ?></p>
        <p><strong>Precio:</strong> $<?= number_format($recurso['precio'], 2) ?></p>

        <p><strong>Sellado:</strong> <?= $recurso['sellado'] ? 'Sí' : 'No' ?></p>
        <p><strong>Etiquetado:</strong> <?= $recurso['etiquetado'] ? 'Sí' : 'No' ?></p>

        <?php if (!empty($recurso['archivo'])): ?>
            <p><strong>Archivo:</strong> <a href="<?= base_url('uploads/' . esc($recurso['archivo'])) ?>" target="_blank"><?= esc($recurso['archivo']) ?></a></p>
        <?php endif; ?>

        <p><strong>Descripción:</strong> <?= esc($recurso['descripcion']) ?></p>
        <p><strong>Temas:</strong> <?= esc($recurso['temas']) ?></p>
        <p><strong>Notas:</strong> <?= esc($recurso['notas']) ?></p>
        <p><strong>Tipo:</strong> <?= esc($recurso['tipo']) ?></p>
    </div>
</div>

<div class="mt-4">
    <a href="<?= base_url('admin/recursos') ?>" class="btn btn-secondary">Volver a la lista</a>
    <a href="<?= base_url('admin/recursos/edit/' . $recurso['id']) ?>" class="btn btn-primary">Editar</a>
</div>

<?= $this->endSection(); ?>
