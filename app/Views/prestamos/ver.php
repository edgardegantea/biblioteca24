<?= $this->extend('layout/main'); ?>
<?= $this->section('content'); ?>

    <h1>Detalles del Préstamo</h1>

    <p><strong>ID del Préstamo:</strong> <?= $prestamo['id_prestamo'] ?></p>
    <p><strong>Usuario:</strong> <?= $prestamo['id_usuario'] ?></p>
    <p><strong>Fecha de Préstamo:</strong> <?= $prestamo['fecha_prestamo'] ?></p>
    <p><strong>Fecha de Devolución:</strong> <?= $prestamo['fecha_devolucion'] ?></p>
    <p><strong>Estado:</strong> <?= $prestamo['estado'] ?></p>
    <p><strong>Observaciones:</strong> <?= $prestamo['observaciones'] ?></p>

    <h2>Recursos</h2>
    <ul>
        <?php foreach ($detalles as $detalle) : ?>
            <li><?= $detalle['nombre_recurso'] ?></li>
        <?php endforeach; ?>
    </ul>

    <a href="/admin/prestamos" class="btn btn-primary">Volver a la lista</a>

<?= $this->endSection(); ?>