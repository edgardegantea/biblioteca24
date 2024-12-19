<?= $this->extend('layout/main'); ?>
<?= $this->section('content'); ?>

<div class="container">
    <h2>Crear Usuario</h2>

    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success"><?= session()->getFlashdata('success'); ?></div>
    <?php endif; ?>

    <?php if (session()->getFlashdata('error')): ?>
        <div class="alert alert-danger"><?= session()->getFlashdata('error'); ?></div>
    <?php endif; ?>

    <form action="<?= base_url('admin/usuarios/store'); ?>" method="post">
        <?= csrf_field() ?>

        <!-- Role -->
        <div class="form-group">
            <label for="role">Rol:</label>
            <select name="role" class="form-select <?= session('validation') && session('validation')->hasError('role') ? 'is-invalid' : '' ?>">
                <option value="admin" <?= old('role') === 'admin' ? 'selected' : '' ?>>Administrador</option>
                <option value="docente" <?= old('role') === 'docente' ? 'selected' : '' ?>>Docente</option>
                <option value="usuario" <?= old('role') === 'usuario' ? 'selected' : '' ?>>Usuario Estudiante</option>
                <option value="externo" <?= old('role') === 'externo' ? 'selected' : '' ?>>Externo</option>
            </select>
            <?php if (session('validation') && session('validation')->hasError('role')): ?>
                <div class="invalid-feedback"><?= session('validation')->getError('role') ?></div>
            <?php endif; ?>
        </div>

        <!-- Matrícula -->
        <div class="form-group">
            <label for="matricula">Matrícula:</label>
            <input type="text" class="form-control <?= session('validation') && session('validation')->hasError('matricula') ? 'is-invalid' : '' ?>" id="matricula" name="matricula" value="<?= old('matricula'); ?>">
            <?php if (session('validation') && session('validation')->hasError('matricula')): ?>
                <div class="invalid-feedback"><?= session('validation')->getError('matricula') ?></div>
            <?php endif; ?>
        </div>

        <!-- Nombre -->
        <div class="form-group">
            <label for="nombre">Nombre (s):</label>
            <input type="text" class="form-control <?= session('validation') && session('validation')->hasError('nombre') ? 'is-invalid' : '' ?>" id="nombre" name="nombre" value="<?= old('nombre'); ?>">
            <?php if (session('validation') && session('validation')->hasError('nombre')): ?>
                <div class="invalid-feedback"><?= session('validation')->getError('nombre') ?></div>
            <?php endif; ?>
        </div>

        <!-- Apellido paterno -->
        <div class="form-group">
            <label for="apaterno">Apellido paterno:</label>
            <input type="text" class="form-control <?= session('validation') && session('validation')->hasError('apaterno') ? 'is-invalid' : '' ?>" id="apaterno" name="apaterno" value="<?= old('apaterno'); ?>">
            <?php if (session('validation') && session('validation')->hasError('apaterno')): ?>
                <div class="invalid-feedback"><?= session('validation')->getError('apaterno') ?></div>
            <?php endif; ?>
        </div>

        <!-- Apellido materno -->
        <div class="form-group">
            <label for="amaterno">Apellido materno:</label>
            <input type="text" class="form-control <?= session('validation') && session('validation')->hasError('amaterno') ? 'is-invalid' : '' ?>" id="amaterno" name="amaterno" value="<?= old('amaterno'); ?>">
            <?php if (session('validation') && session('validation')->hasError('amaterno')): ?>
                <div class="invalid-feedback"><?= session('validation')->getError('amaterno') ?></div>
            <?php endif; ?>
        </div>

        <!-- Teléfono -->
        <div class="form-group">
            <label for="telefono">Teléfono:</label>
            <input type="text" class="form-control <?= session('validation') && session('validation')->hasError('telefono') ? 'is-invalid' : '' ?>" id="telefono" name="telefono" value="<?= old('telefono'); ?>">
            <?php if (session('validation') && session('validation')->hasError('telefono')): ?>
                <div class="invalid-feedback"><?= session('validation')->getError('telefono') ?></div>
            <?php endif; ?>
        </div>

        <!-- Correo Electrónico -->
        <div class="form-group">
            <label for="email">Correo Electrónico:</label>
            <input type="email" class="form-control <?= session('validation') && session('validation')->hasError('email') ? 'is-invalid' : '' ?>" id="email" name="email" value="<?= old('email'); ?>">
            <?php if (session('validation') && session('validation')->hasError('email')): ?>
                <div class="invalid-feedback"><?= session('validation')->getError('email') ?></div>
            <?php endif; ?>
        </div>

        <!-- Nombre de Usuario -->
        <div class="form-group">
            <label for="username">Nombre de Usuario:</label>
            <input type="text" class="form-control <?= session('validation') && session('validation')->hasError('username') ? 'is-invalid' : '' ?>" id="username" name="username" value="<?= old('username'); ?>">
            <?php if (session('validation') && session('validation')->hasError('username')): ?>
                <div class="invalid-feedback"><?= session('validation')->getError('username') ?></div>
            <?php endif; ?>
        </div>

        <!-- Contraseña -->
        <div class="form-group">
            <label for="password">Contraseña:</label>
            <input type="password" class="form-control <?= session('validation') && session('validation')->hasError('password') ? 'is-invalid' : '' ?>" id="password" name="password">
            <?php if (session('validation') && session('validation')->hasError('password')): ?>
                <div class="invalid-feedback"><?= session('validation')->getError('password') ?></div>
            <?php endif; ?>
        </div>

        <!-- Activo -->
        <div class="form-check">
            <input type="checkbox" class="form-check-input" id="active" name="active" value="1" <?= old('active') ? 'checked' : '' ?>>
            <label class="form-check-label" for="active">Activo</label>
        </div>

        <!-- Perfil Completo -->
        <div class="form-check">
            <input type="checkbox" class="form-check-input" id="is_profile_complete" name="is_profile_complete" value="1" <?= old('is_profile_complete') ? 'checked' : '' ?>>
            <label class="form-check-label" for="is_profile_complete">Perfil Completo</label>
        </div>

        <button type="submit" class="btn btn-primary">Guardar</button>
        <a href="<?= base_url('admin/usuarios') ?>" class="btn btn-secondary">Cancelar</a>
    </form>
</div>

<?= $this->endSection(); ?>
