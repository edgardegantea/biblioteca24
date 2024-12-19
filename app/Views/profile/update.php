<form action="/profile/update" method="post">
    <?= csrf_field() ?>

    <?php if (isset($validation)): ?>
        <div>
            <p><?= $validation->listErrors() ?></p>
        </div>
    <?php endif; ?>

    <label for="name">Nombre</label>
    <input type="text" name="name" value="<?= old('name', $user['name']) ?>">

    <label for="email">Correo electrónico</label>
    <input type="email" name="email" value="<?= old('email', $user['email']) ?>">

    <!-- Otros campos adicionales si es necesario -->

    <button type="submit">Actualizar perfil</button>
</form>
