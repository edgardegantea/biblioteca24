<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Detalles del Archivo</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/epub.js/0.3.88/epub.min.js"></script> <!-- Para visualizar EPUB -->
</head>
<body>

<h1>Detalles del Archivo</h1>

<p><strong>Nombre:</strong> <?= esc($archivo['nombre']) ?></p>
<p><strong>Ruta:</strong> <?= esc($archivo['ruta']) ?></p>
<p><strong>Peso:</strong> <?= esc($archivo['peso']) ?> bytes</p>
<p><strong>Tipo:</strong> <?= esc($archivo['tipo']) ?></p>
<p><strong>Clasificación ID:</strong> <?= esc($archivo['clasificacion_id']) ?></p>

<h2>Contenido del Archivo</h2>

<?php if ($archivo['tipo'] === 'application/pdf'): ?>
    <!-- Visualización de PDF -->
    <iframe src="<?= $rutaArchivo ?>" width="100%" height="600px"></iframe>
<?php elseif ($archivo['tipo'] === 'application/epub+zip'): ?>
    <!-- Contenedor para EPUB -->
    <div id="epub-viewer" style="width:100%; height:600px; border:1px solid #ccc;"></div>
    <script>
        // Inicializa el visor EPUB usando epub.js
        var book = ePub("<?= $rutaArchivo ?>");
        var rendition = book.renderTo("epub-viewer", {
            width: "100%",
            height: "100%"
        });
        rendition.display();
    </script>
<?php else: ?>
    <p>El archivo no es de tipo PDF o EPUB, y no se puede visualizar directamente.</p>
<?php endif; ?>

<a href="<?= base_url('admin/archivos') ?>">Volver a la lista de archivos</a>

</body>
</html>
