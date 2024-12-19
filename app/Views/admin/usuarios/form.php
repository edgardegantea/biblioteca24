<?= $this->extend('layout/main'); ?>
<?= $this->section('content'); ?>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<div class="container">
    <h2><?= isset($user) ? 'Editar Usuario' : 'Crear Usuario'; ?></h2>

    <?php if (session()->getFlashdata('error')): ?>
        <div class="alert alert-danger"><?= session()->getFlashdata('error'); ?></div>
    <?php endif; ?>

    <form id="userForm" action="<?= base_url('admin/users' . (isset($user) ? '/update/' . $user['id'] : '/store')); ?>" method="post">
        <?= csrf_field() ?>
        <?php if (isset($user)): ?>
            <input type="hidden" name="_method" value="PUT" />
        <?php endif; ?>

        <!-- Nombre -->
        <div class="form-group">
            <label for="nombre">Nombre (s):</label>
            <input type="text" class="form-control <?= session('validation') && session('validation')->hasError('nombre') ? 'is-invalid' : '' ?>" id="nombre" name="nombre" value="<?= old('nombre', isset($user) ? $user['nombre'] : ''); ?>">
            <?php if (session('validation') && session('validation')->hasError('nombre')): ?>
                <div class="invalid-feedback"><?= session('validation')->getError('nombre') ?></div>
            <?php endif; ?>
        </div>

        <!-- Apellido paterno -->
        <div class="form-group">
            <label for="apaterno">Apellido paterno:</label>
            <input type="text" class="form-control <?= session('validation') && session('validation')->hasError('apaterno') ? 'is-invalid' : '' ?>" id="apaterno" name="apaterno" value="<?= old('apaterno', isset($user) ? $user['apaterno'] : ''); ?>">
            <?php if (session('validation') && session('validation')->hasError('apaterno')): ?>
                <div class="invalid-feedback"><?= session('validation')->getError('apaterno') ?></div>
            <?php endif; ?>
        </div>

        <!-- Apellido materno -->
        <div class="form-group">
            <label for="amaterno">Apellido materno:</label>
            <input type="text" class="form-control <?= session('validation') && session('validation')->hasError('amaterno') ? 'is-invalid' : '' ?>" id="amaterno" name="amaterno" value="<?= old('amaterno', isset($user) ? $user['amaterno'] : ''); ?>">
            <?php if (session('validation') && session('validation')->hasError('amaterno')): ?>
                <div class="invalid-feedback"><?= session('validation')->getError('amaterno') ?></div>
            <?php endif; ?>
        </div>

        <!-- Teléfono -->
        <div class="form-group">
            <label for="telefono">Teléfono:</label>
            <input type="text" class="form-control <?= session('validation') && session('validation')->hasError('telefono') ? 'is-invalid' : '' ?>" id="telefono" name="telefono" value="<?= old('telefono', isset($user) ? $user['telefono'] : ''); ?>">
            <?php if (session('validation') && session('validation')->hasError('telefono')): ?>
                <div class="invalid-feedback"><?= session('validation')->getError('telefono') ?></div>
            <?php endif; ?>
        </div>

        <!-- Correo Electrónico -->
        <div class="form-group">
            <label for="email">Correo Electrónico:</label>
            <input type="email" class="form-control <?= session('validation') && session('validation')->hasError('email') ? 'is-invalid' : '' ?>" id="email" name="email" value="<?= old('email', isset($user) ? $user['email'] : ''); ?>">
            <?php if (session('validation') && session('validation')->hasError('email')): ?>
                <div class="invalid-feedback"><?= session('validation')->getError('email') ?></div>
            <?php endif; ?>
        </div>

        <!-- Rol -->
        <div class="form-group">
            <label for="rol">Rol:</label>
            <select name="rol" class="form-control <?= session('validation') && session('validation')->hasError('rol') ? 'is-invalid' : '' ?>">
                <option value="admin" <?= old('rol', isset($user) && $user['rol'] === 'admin' ? 'selected' : '') ?>>Administrador</option>
                <option value="docente" <?= old('rol', isset($user) && $user['rol'] === 'docente' ? 'selected' : '') ?>>Docente</option>
                <option value="usuario" <?= old('rol', isset($user) && $user['rol'] === 'usuario' ? 'selected' : '') ?>>Usuario Estudiante</option>
                <option value="externo" <?= old('rol', isset($user) && $user['rol'] === 'externo' ? 'selected' : '') ?>>Externo</option>
            </select>
            <?php if (session('validation') && session('validation')->hasError('rol')): ?>
                <div class="invalid-feedback"><?= session('validation')->getError('rol') ?></div>
            <?php endif; ?>
        </div>

        <!-- Nombre de Usuario -->
        <div class="form-group">
            <label for="username">Nombre de Usuario:</label>
            <input type="text" class="form-control <?= session('validation') && session('validation')->hasError('username') ? 'is-invalid' : '' ?>" id="username" name="username" value="<?= old('username', isset($user) ? $user['username'] : ''); ?>">
            <?php if (session('validation') && session('validation')->hasError('username')): ?>
                <div class="invalid-feedback"><?= session('validation')->getError('username') ?></div>
            <?php endif; ?>
        </div>

        <!-- Contraseña (solo en creación o si se quiere cambiar en edición) -->
        <?php if (!isset($user)): ?>
            <div class="form-group">
                <label for="password">Contraseña:</label>
                <input type="password" class="form-control <?= session('validation') && session('validation')->hasError('password') ? 'is-invalid' : '' ?>" id="password" name="password">
                <?php if (session('validation') && session('validation')->hasError('password')): ?>
                    <div class="invalid-feedback"><?= session('validation')->getError('password') ?></div>
                <?php endif; ?>
            </div>

            <div class="form-group">
                <label for="confirm_password">Confirmar Contraseña:</label>
                <input type="password" class="form-control <?= session('validation') && session('validation')->hasError('confirm_password') ? 'is-invalid' : '' ?>" id="confirm_password" name="confirm_password">
                <?php if (session('validation') && session('validation')->hasError('confirm_password')): ?>
                    <div class="invalid-feedback"><?= session('validation')->getError('confirm_password') ?></div>
                <?php endif; ?>
            </div>
        <?php endif; ?>

        <button type="submit" class="btn btn-primary">Guardar</button>
        <a href="<?= base_url('admin/users') ?>" class="btn btn-secondary">Cancelar</a>
    </form>
</div>

<script>
    document.addEventListener('DOMContentLoaded', (event) => {
        const form = document.getElementById('userForm');

        form.addEventListener('submit', (event) => {
            event.preventDefault();

            const formData = new FormData(form);

            fetch(form.action, {
                method: form.getAttribute('method'),
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
                .then(response => {
                    if (!response.ok) {
                        if (response.status === 400) {
                            return response.json().then(data => {
                                throw new Error(Object.values(data.errors).join("<br>"));
                            });
                        } else {
                            throw new Error('Ocurrió un error.');
                        }
                    }
                    return response.json();
                })
                .then(data => {
                    Swal.fire({
                        icon: 'success',
                        title: data.message,
                    }).then(() => {
                        window.location.href = "<?= base_url('admin/users') ?>";
                    });
                })
                .catch(error => {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        html: error.message
                    });
                });
        });
    });
</script>

<?= $this->endSection(); ?>
