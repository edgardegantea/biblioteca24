<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>

<h2>Registrar recurso bibliográfico</h2>
<form action="<?= base_url('admin/recursos/step5') ?>" method="post" enctype="multipart/form-data">

    <!-- Campo Título -->
    <div class="form-group">
        <label>Título del recurso bibliográfico:</label>
        <input class="form-control <?= session('validation') && session('validation')->hasError('titulo') ? 'is-invalid' : '' ?>" type="text" name="titulo" value="<?= old('titulo') ?>" required>
        <?php if (session('validation') && session('validation')->hasError('titulo')): ?>
            <div class="invalid-feedback">
                <?= session('validation')->getError('titulo'); ?>
            </div>
        <?php endif; ?>
    </div>

    <!-- Campo ISBN -->
    <div class="form-group">
        <label for="isbn">ISBN:</label>
        <input class="form-control <?= session('validation') && session('validation')->hasError('isbn') ? 'is-invalid' : '' ?>" type="text" name="isbn" maxlength="20" value="<?= old('isbn') ?>" required>
        <?php if (session('validation') && session('validation')->hasError('isbn')): ?>
            <div class="invalid-feedback">
                <?= session('validation')->getError('isbn'); ?>
            </div>
        <?php endif; ?>
    </div>

    <!-- Subtítulo -->
    <div class="form-group">
        <label>Subtítulo:</label>
        <input type="text" class="form-control <?= session('validation') && session('validation')->hasError('subtitulo') ? 'is-invalid' : '' ?>" name="subtitulo" value="<?= old('subtitulo') ?>">
        <?php if (session('validation') && session('validation')->hasError('subtitulo')): ?>
            <div class="invalid-feedback">
                <?= session('validation')->getError('subtitulo'); ?>
            </div>
        <?php endif; ?>
    </div>

    <!-- Año de Publicación -->
    <div class="form-group">
        <label>Año de Publicación:</label>
        <input type="number" class="form-control <?= session('validation') && session('validation')->hasError('anio_publicacion') ? 'is-invalid' : '' ?>" name="anio_publicacion" value="<?= old('anio_publicacion') ?>">
        <?php if (session('validation') && session('validation')->hasError('anio_publicacion')): ?>
            <div class="invalid-feedback">
                <?= session('validation')->getError('anio_publicacion'); ?>
            </div>
        <?php endif; ?>
    </div>

    <!-- Idioma -->
    <div class="form-group">
        <label>Idioma:</label>
        <input type="text" class="form-control <?= session('validation') && session('validation')->hasError('idioma') ? 'is-invalid' : '' ?>" name="idioma" value="<?= old('idioma') ?>">
        <?php if (session('validation') && session('validation')->hasError('idioma')): ?>
            <div class="invalid-feedback">
                <?= session('validation')->getError('idioma'); ?>
            </div>
        <?php endif; ?>
    </div>

    <!-- Edición -->
    <div class="form-group">
        <label>Edición:</label>
        <input type="text" class="form-control <?= session('validation') && session('validation')->hasError('edicion') ? 'is-invalid' : '' ?>" name="edicion" value="<?= old('edicion') ?>">
        <?php if (session('validation') && session('validation')->hasError('edicion')): ?>
            <div class="invalid-feedback">
                <?= session('validation')->getError('edicion'); ?>
            </div>
        <?php endif; ?>
    </div>

    <!-- Portada -->
    <div class="form-group">
        <label>Portada:</label>
        <input type="file" accept="image/*" class="form-control <?= session('validation') && session('validation')->hasError('portada') ? 'is-invalid' : '' ?>" name="portada">
        <?php if (session('validation') && session('validation')->hasError('portada')): ?>
            <div class="invalid-feedback">
                <?= session('validation')->getError('portada'); ?>
            </div>
        <?php endif; ?>
    </div>

    <!-- Páginas -->
    <div class="form-group">
        <label>Páginas:</label>
        <input type="number" class="form-control <?= session('validation') && session('validation')->hasError('paginas') ? 'is-invalid' : '' ?>" name="paginas" value="<?= old('paginas') ?>">
        <?php if (session('validation') && session('validation')->hasError('paginas')): ?>
            <div class="invalid-feedback">
                <?= session('validation')->getError('paginas'); ?>
            </div>
        <?php endif; ?>
    </div>

    <!-- Fecha de Publicación -->
    <div class="form-group">
        <label>Fecha de Publicación:</label>
        <input type="date" class="form-control <?= session('validation') && session('validation')->hasError('fecha_publicacion') ? 'is-invalid' : '' ?>" name="fecha_publicacion" value="<?= old('fecha_publicacion') ?>">
        <?php if (session('validation') && session('validation')->hasError('fecha_publicacion')): ?>
            <div class="invalid-feedback">
                <?= session('validation')->getError('fecha_publicacion'); ?>
            </div>
        <?php endif; ?>
    </div>

    <!-- Clasificación -->
    <div class="form-group">
        <label>Clasificación:</label>
        <input type="text" class="form-control <?= session('validation') && session('validation')->hasError('clasificacion') ? 'is-invalid' : '' ?>" name="clasificacion" value="<?= old('clasificacion') ?>">
        <?php if (session('validation') && session('validation')->hasError('clasificacion')): ?>
            <div class="invalid-feedback">
                <?= session('validation')->getError('clasificacion'); ?>
            </div>
        <?php endif; ?>
    </div>

    <!-- Formato -->
    <div class="form-group">
        <label>Formato:</label>
        <select class="form-select <?= session('validation') && session('validation')->hasError('formato') ? 'is-invalid' : '' ?>" name="formato">
            <option value="">Selecciona un formato</option>
            <option value="libro" <?= old('formato') === 'libro' ? 'selected' : '' ?>>Libro</option>
            <option value="mapa" <?= old('formato') === 'mapa' ? 'selected' : '' ?>>Mapa</option>
            <option value="compendio" <?= old('formato') === 'compendio' ? 'selected' : '' ?>>Compendio</option>
            <option value="catálogo" <?= old('formato') === 'catálogo' ? 'selected' : '' ?>>Catálogo</option>
            <option value="revista" <?= old('formato') === 'revista' ? 'selected' : '' ?>>Revista</option>
            <option value="audiolibro" <?= old('formato') === 'audiolibro' ? 'selected' : '' ?>>Audiolibro</option>
            <option value="video" <?= old('formato') === 'video' ? 'selected' : '' ?>>Video</option>
            <option value="CD" <?= old('formato') === 'CD' ? 'selected' : '' ?>>CD</option>
            <option value="USB" <?= old('formato') === 'USB' ? 'selected' : '' ?>>USB</option>
            <option value="DVD" <?= old('formato') === 'DVD' ? 'selected' : '' ?>>DVD</option>
            <option value="otro" <?= old('formato') === 'otro' ? 'selected' : '' ?>>Otro</option>
        </select>
        <?php if (session('validation') && session('validation')->hasError('formato')): ?>
            <div class="invalid-feedback">
                <?= session('validation')->getError('formato'); ?>
            </div>
        <?php endif; ?>
    </div>

    <!-- Precio -->
    <div class="form-group">
        <label>Precio:</label>
        <input type="number" step="0.01" class="form-control <?= session('validation') && session('validation')->hasError('precio') ? 'is-invalid' : '' ?>" name="precio" value="<?= old('precio') ?>">
        <?php if (session('validation') && session('validation')->hasError('precio')): ?>
            <div class="invalid-feedback">
                <?= session('validation')->getError('precio'); ?>
            </div>
        <?php endif; ?>
    </div>

    <!-- Sellado -->
    <div class="form-group form-check">
        <input type="checkbox" class="form-check-input <?= session('validation') && session('validation')->hasError('sellado') ? 'is-invalid' : '' ?>" name="sellado" value="1" <?= old('sellado') ? 'checked' : '' ?>>
        <label class="form-check-label">Sellado</label>
        <?php if (session('validation') && session('validation')->hasError('sellado')): ?>
            <div class="invalid-feedback d-block">
                <?= session('validation')->getError('sellado'); ?>
            </div>
        <?php endif; ?>
    </div>

    <!-- Etiquetado -->
    <div class="form-group form-check">
        <input type="checkbox" class="form-check-input <?= session('validation') && session('validation')->hasError('etiquetado') ? 'is-invalid' : '' ?>" name="etiquetado" value="1" <?= old('etiquetado') ? 'checked' : '' ?>>
        <label class="form-check-label">Etiquetado</label>
        <?php if (session('validation') && session('validation')->hasError('etiquetado')): ?>
            <div class="invalid-feedback d-block">
                <?= session('validation')->getError('etiquetado'); ?>
            </div>
        <?php endif; ?>
    </div>

    <!-- Archivo -->
    <div class="form-group">
        <label>Archivo:</label>
        <input type="file" accept=".pdf,.epub,.mobi" class="form-control <?= session('validation') && session('validation')->hasError('archivo') ? 'is-invalid' : '' ?>" name="archivo">
        <?php if (session('validation') && session('validation')->hasError('archivo')): ?>
            <div class="invalid-feedback">
                <?= session('validation')->getError('archivo'); ?>
            </div>
        <?php endif; ?>
    </div>

    <!-- Descripción -->
    <div class="form-group">
        <label>Descripción:</label>
        <textarea class="form-control <?= session('validation') && session('validation')->hasError('descripcion') ? 'is-invalid' : '' ?>" name="descripcion"><?= old('descripcion') ?></textarea>
        <?php if (session('validation') && session('validation')->hasError('descripcion')): ?>
            <div class="invalid-feedback">
                <?= session('validation')->getError('descripcion'); ?>
            </div>
        <?php endif; ?>
    </div>

    <!-- Temas -->
    <div class="form-group">
        <label>Temas:</label>
        <textarea class="form-control <?= session('validation') && session('validation')->hasError('temas') ? 'is-invalid' : '' ?>" name="temas"><?= old('temas') ?></textarea>
        <?php if (session('validation') && session('validation')->hasError('temas')): ?>
            <div class="invalid-feedback">
                <?= session('validation')->getError('temas'); ?>
            </div>
        <?php endif; ?>
    </div>

    <!-- Notas -->
    <div class="form-group">
        <label>Notas:</label>
        <textarea class="form-control <?= session('validation') && session('validation')->hasError('notas') ? 'is-invalid' : '' ?>" name="notas"><?= old('notas') ?></textarea>
        <?php if (session('validation') && session('validation')->hasError('notas')): ?>
            <div class="invalid-feedback">
                <?= session('validation')->getError('notas'); ?>
            </div>
        <?php endif; ?>
    </div>

    <!-- Tipo -->
    <div class="form-group">
        <label>Tipo:</label>
        <input type="text" class="form-control <?= session('validation') && session('validation')->hasError('tipo') ? 'is-invalid' : '' ?>" name="tipo" value="<?= old('tipo') ?>">
        <?php if (session('validation') && session('validation')->hasError('tipo')): ?>
            <div class="invalid-feedback">
                <?= session('validation')->getError('tipo'); ?>
            </div>
        <?php endif; ?>
    </div>

    <!-- Botón de envío -->
    <div class="mt-3">
        <button class="btn btn-primary" type="submit">Guardar recurso bibliográfico</button>
    </div>

</form>

<?= $this->endSection(); ?>
