<?= $this->extend('layout/main'); ?>
<?= $this->section('content'); ?>

<div class="container">
    <h2>Detalles del Usuario</h2>

    <div class="card mt-4">
        <div class="card-body">
            <h5 class="card-title"><?= esc($user['nombre']) ?> <?= esc($user['apaterno']) ?> <?= esc($user['amaterno']) ?></h5>
            <br>
            <p><strong>Nombre de Usuario:</strong> <?= esc($user['username']) ?></p>
            <p><strong>Correo Electrónico:</strong> <?= esc($user['email']) ?></p>
            <p><strong>Teléfono:</strong> <?= esc($user['telefono']) ?></p>

            <a href="<?= base_url('admin/usuarios') ?>" class="btn btn-secondary">Volver a la lista</a>
            <a href="<?= base_url('admin/usuarios/edit/' . $user['id']) ?>" class="btn btn-primary">Editar</a>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>
