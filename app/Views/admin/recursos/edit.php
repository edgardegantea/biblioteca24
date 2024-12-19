<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>
<h1>Editar Recurso</h1>

<form action="<?= base_url('admin/recursos/update/' . $recurso['id']) ?>" method="post" enctype="multipart/form-data">
    <?= csrf_field() ?>
    <input type="hidden" name="_method" value="PUT">

    <!-- Título -->
    <div class="mb-3">
        <label for="titulo" class="form-label">Título:</label>
        <input type="text" class="form-control" name="titulo" value="<?= old('titulo', $recurso['titulo'] ?? '') ?>">
        <?php if (session('errors.titulo')): ?>
            <div class="text-danger"><?= session('errors.titulo') ?></div>
        <?php endif; ?>
    </div>

    <!-- Subtítulo -->
    <div class="mb-3">
        <label for="subtitulo" class="form-label">Subtítulo:</label>
        <input type="text" class="form-control" name="subtitulo" value="<?= old('subtitulo', $recurso['subtitulo'] ?? '') ?>">
        <?php if (session('errors.subtitulo')): ?>
            <div class="text-danger"><?= session('errors.subtitulo') ?></div>
        <?php endif; ?>
    </div>

    <!-- Género -->
    <div class="mb-3">
        <label for="genero" class="form-label">Género:</label>
        <select name="genero" id="genero" class="form-control">
            <?php foreach ($generos as $genero): ?>
                <option value="<?= $genero['id'] ?>" <?= old('genero', $recurso['genero'] ?? '') == $genero['id'] ? 'selected' : '' ?>>
                    <?= $genero['nombre'] ?>
                </option>
            <?php endforeach; ?>
        </select>
        <?php if (session('errors.genero')): ?>
            <div class="text-danger"><?= session('errors.genero') ?></div>
        <?php endif; ?>
    </div>

    <!-- ISBN -->
    <div class="mb-3">
        <label for="isbn" class="form-label">ISBN:</label>
        <input type="text" class="form-control" name="isbn" value="<?= old('isbn', $recurso['isbn'] ?? '') ?>">
        <?php if (session('errors.isbn')): ?>
            <div class="text-danger"><?= session('errors.isbn') ?></div>
        <?php endif; ?>
    </div>

    <!-- Año de Publicación -->
    <div class="mb-3">
        <label for="anio_publicacion" class="form-label">Año de Publicación:</label>
        <input type="number" class="form-control" name="anio_publicacion" value="<?= old('anio_publicacion', $recurso['anio_publicacion'] ?? '') ?>">
        <?php if (session('errors.anio_publicacion')): ?>
            <div class="text-danger"><?= session('errors.anio_publicacion') ?></div>
        <?php endif; ?>
    </div>

    <!-- Idioma -->
    <div class="mb-3">
        <label for="idioma" class="form-label">Idioma:</label>
        <input type="text" class="form-control" name="idioma" value="<?= old('idioma', $recurso['idioma'] ?? '') ?>">
        <?php if (session('errors.idioma')): ?>
            <div class="text-danger"><?= session('errors.idioma') ?></div>
        <?php endif; ?>
    </div>

    <!-- Editorial -->
    <div class="mb-3">
        <label for="editorial" class="form-label">Editorial:</label>
        <select name="editorial" id="editorial" class="form-control">
            <?php foreach ($editoriales as $editorial): ?>
                <option value="<?= $editorial['id'] ?>" <?= old('editorial', $recurso['editorial'] ?? '') == $editorial['id'] ? 'selected' : '' ?>>
                    <?= $editorial['nombre'] ?>
                </option>
            <?php endforeach; ?>
        </select>
        <?php if (session('errors.editorial')): ?>
            <div class="text-danger"><?= session('errors.editorial') ?></div>
        <?php endif; ?>
    </div>

    <!-- Edición -->
    <div class="mb-3">
        <label for="edicion" class="form-label">Edición:</label>
        <input type="text" class="form-control" name="edicion" value="<?= old('edicion', $recurso['edicion'] ?? '') ?>">
        <?php if (session('errors.edicion')): ?>
            <div class="text-danger"><?= session('errors.edicion') ?></div>
        <?php endif; ?>
    </div>

    <!-- Descripción -->
    <div class="mb-3">
        <label for="descripcion" class="form-label">Descripción:</label>
        <textarea class="form-control" name="descripcion"><?= old('descripcion', $recurso['descripcion'] ?? '') ?></textarea>
        <?php if (session('errors.descripcion')): ?>
            <div class="text-danger"><?= session('errors.descripcion') ?></div>
        <?php endif; ?>
    </div>

    <!-- Portada -->
    <div class="mb-3">
        <label for="portada" class="form-label">Portada:</label>
        <input type="file" class="form-control" name="portada" accept="image/*">
        <?php if (session('errors.portada')): ?>
            <div class="text-danger"><?= session('errors.portada') ?></div>
        <?php endif; ?>
        <?php if (isset($recurso['portada'])): ?>
            <img src="<?= base_url('uploads/' . $recurso['portada']) ?>" alt="Portada del Recurso" class="img-thumbnail mt-2" width="100">
        <?php endif; ?>
    </div>

    <!-- Páginas -->
    <div class="mb-3">
        <label for="paginas" class="form-label">Páginas:</label>
        <input type="number" class="form-control" name="paginas" value="<?= old('paginas', $recurso['paginas'] ?? '') ?>">
        <?php if (session('errors.paginas')): ?>
            <div class="text-danger"><?= session('errors.paginas') ?></div>
        <?php endif; ?>
    </div>

    <!-- Fecha de Publicación -->
    <div class="mb-3">
        <label for="fecha_publicacion" class="form-label">Fecha de Publicación:</label>
        <input type="date" class="form-control" name="fecha_publicacion" value="<?= old('fecha_publicacion', $recurso['fecha_publicacion'] ?? '') ?>">
        <?php if (session('errors.fecha_publicacion')): ?>
            <div class="text-danger"><?= session('errors.fecha_publicacion') ?></div>
        <?php endif; ?>
    </div>

    <!-- Clasificación -->
    <div class="mb-3">
        <label for="clasificacion" class="form-label">Clasificación:</label>
        <input type="text" class="form-control" name="clasificacion" value="<?= old('clasificacion', $recurso['clasificacion'] ?? '') ?>">
        <?php if (session('errors.clasificacion')): ?>
            <div class="text-danger"><?= session('errors.clasificacion') ?></div>
        <?php endif; ?>
    </div>

    <!-- Temas -->
    <div class="mb-3">
        <label for="temas" class="form-label">Temas:</label>
        <textarea class="form-control" name="temas"><?= old('temas', $recurso['temas'] ?? '') ?></textarea>
        <?php if (session('errors.temas')): ?>
            <div class="text-danger"><?= session('errors.temas') ?></div>
        <?php endif; ?>
    </div>

    <!-- Formato -->
    <div class="mb-3">
        <label for="formato" class="form-label">Formato:</label>
        <input type="text" class="form-control" name="formato" value="<?= old('formato', $recurso['formato'] ?? '') ?>">
        <?php if (session('errors.formato')): ?>
            <div class="text-danger"><?= session('errors.formato') ?></div>
        <?php endif; ?>
    </div>

    <!-- Precio -->
    <div class="mb-3">
        <label for="precio" class="form-label">Precio:</label>
        <input type="number" class="form-control" name="precio" step="0.01" value="<?= old('precio', $recurso['precio'] ?? '') ?>">
        <?php if (session('errors.precio')): ?>
            <div class="text-danger"><?= session('errors.precio') ?></div>
        <?php endif; ?>
    </div>

    <!-- Sellado -->
    <div class="form-check">
        <input type="checkbox" class="form-check-input" name="sellado" value="1" <?= old('sellado', $recurso['sellado'] ?? '') ? 'checked' : '' ?>>
        <label class="form-check-label" for="sellado">Sellado</label>
    </div>

    <!-- Etiquetado -->
    <div class="form-check">
        <input type="checkbox" class="form-check-input" name="etiquetado" value="1" <?= old('etiquetado', $recurso['etiquetado'] ?? '') ? 'checked' : '' ?>>
        <label class="form-check-label" for="etiquetado">Etiquetado</label>
    </div>

    <!-- Notas -->
    <div class="mb-3">
        <label for="notas" class="form-label">Notas:</label>
        <textarea class="form-control" name="notas"><?= old('notas', $recurso['notas'] ?? '') ?></textarea>
        <?php if (session('errors.notas')): ?>
            <div class="text-danger"><?= session('errors.notas') ?></div>
        <?php endif; ?>
    </div>

    <!-- Tipo -->
    <div class="mb-3">
        <label for="tipo" class="form-label">Tipo:</label>
        <input type="text" class="form-control" name="tipo" value="<?= old('tipo', $recurso['tipo'] ?? '') ?>">
        <?php if (session('errors.tipo')): ?>
            <div class="text-danger"><?= session('errors.tipo') ?></div>
        <?php endif; ?>
    </div>

    <!-- Archivo -->
    <div class="mb-3">
        <label for="archivo" class="form-label">Archivo:</label>
        <input type="file" class="form-control" name="archivo" accept=".pdf">
        <?php if (session('errors.archivo')): ?>
            <div class="text-danger"><?= session('errors.archivo') ?></div>
        <?php endif; ?>
        <?php if (isset($recurso['archivo'])): ?>
            <p class="mt-2">Archivo actual: <a href="<?= base_url('uploads/' . $recurso['archivo']) ?>" target="_blank"><?= $recurso['archivo'] ?></a></p>
        <?php endif; ?>
    </div>

    <!-- Tag -->
    <div class="mb-3">
        <label for="tag" class="form-label">Tag:</label>
        <select name="tag" id="tag" class="form-control">
            <?php foreach ($tags as $tag): ?>
                <option value="<?= $tag['id'] ?>" <?= old('tag', $recurso['tag'] ?? '') == $tag['id'] ? 'selected' : '' ?>>
                    <?= $tag['nombre'] ?>
                </option>
            <?php endforeach; ?>
        </select>
        <?php if (session('errors.tag')): ?>
            <div class="text-danger"><?= session('errors.tag') ?></div>
        <?php endif; ?>
    </div>

    <button type="submit" class="btn btn-primary">Actualizar Recurso</button>
</form>

<?= $this->endSection() ?>
