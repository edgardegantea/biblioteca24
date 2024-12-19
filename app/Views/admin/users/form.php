<?= $this->extend('layout/main'); ?>


<?= $this->section('content'); ?>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <div class="container">
        <h2><?= isset($user) ? 'Editar Usuario' : 'Crear Usuario'; ?></h2>

        <?php if (session()->getFlashdata('error')): ?>
            <div class="alert alert-danger"><?= session()->getFlashdata('error'); ?></div>
        <?php endif; ?>

        <form id="userForm" action="<?= base_url('admin/users' . (isset($user) ? '/' . $user['id'] : '')); ?>" method="post">
            <?php if (isset($user)): ?>
                <input type="hidden" name="_method" value="PUT" />
            <?php endif; ?>

            <div class="form-group">
                <label for="name">Nombre (s):</label>
                <input type="text" class="form-control" id="nombre" name="nombre" value="<?= old('nombre', isset($user['nombre']) ? $user['nombre'] : ''); ?>">
            </div>

            <div class="form-group">
                <label for="name">Apellido paterno:</label>
                <input type="text" class="form-control" id="apaterno" name="apaterno" value="<?= old('apaterno', isset($user['apaterno']) ? $user['apaterno'] : ''); ?>">
            </div>

            <div class="form-group">
                <label for="name">Apellido materno:</label>
                <input type="text" class="form-control" id="amaterno" name="amaterno" value="<?= old('amaterno', isset($user['amaterno']) ? $user['amaterno'] : ''); ?>">
            </div>



            <div class="form-group">
                <label for="name">Teléfono:</label>
                <input type="text" class="form-control" id="telefono" name="telefono" value="<?= old('telefono', isset($user['telefono']) ? $user['telefono'] : ''); ?>">
            </div>


            <div class="form-group">
                <label for="email">Correo Electrónico:</label>
                <input type="email" class="form-control" id="email" name="email" value="<?= old('email', isset($user['email']) ? $user['email'] : ''); ?>">
            </div>

            <div class="form-group">
                <label for="rol">Rol</label>
                <select name="rol" class="form-control">
                    <option value="admin">Administrador</option>
                    <option value="docente">Docente</option>
                    <option value="usuario">Usuario Estudiante</option>
                    <option value="externo">Externo</option>
                </select>
            </div>

            <div class="form-group">
                <label for="username">Nombre de Usuario:</label>
                <input type="text" class="form-control" id="username" name="username" value="<?= old('username', isset($user['username']) ? $user['username'] : ''); ?>">
            </div>

            <?php if (!isset($user)): ?>
                <div class="form-group">
                    <label for="password">Contraseña:</label>
                    <input type="password" class="form-control" id="password" name="password">
                </div>

                <div class="form-group">
                    <label for="confirm_password">Confirmar Contraseña:</label>
                    <input type="password" class="form-control" id="confirm_password" name="confirm_password">
                </div>
            <?php endif; ?>

            <button type="submit" class="btn btn-primary">Guardar</button>
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', (event) => {
            const form = document.getElementById('userForm');

            form.addEventListener('submit', (event) => {
                event.preventDefault();

                const formData = new FormData(form);

                fetch(form.action, {
                    method: form.method,
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
