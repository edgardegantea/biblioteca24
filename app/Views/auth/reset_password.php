<!DOCTYPE html>
<html lang="en">

<head>
    <script src="<?php echo base_url('js/color-modes.js'); ?>"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recuperar contraseña</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        .bd-mode-toggle {
            z-index: 1500;
        }

        .bd-mode-toggle .dropdown-menu .active .bi {
            display: block !important;
        }
    </style>
</head>

<body>
<div class="container d-flex justify-content-center align-items-center min-vh-100">
    <div class="" style="width: 400px;">
        <div class="card-body">
            <h4 class="card-title text-center mb-5">Restablecer contraseña</h4>

            <!-- Mensajes de error o éxito -->
            <?php if (session()->getFlashdata('error')): ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <?= session()->getFlashdata('error') ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>

            <?php if (session()->getFlashdata('message')): ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <?= session()->getFlashdata('message') ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>

            <form id="resetForm" action="/reset-password/update" method="post">
                <?= csrf_field() ?>
                <input type="hidden" name="token" value="<?= $token; ?>">

                <div class="mb-3">
                    <label for="password" class="form-label">Nueva Contraseña:</label>
                    <input type="password" name="password" id="password" class="form-control" required>
                    <div id="passwordHelp" class="form-text text-danger"></div>
                    <div id="passwordSuggestion" class="form-text text-success"></div>
                </div>

                <button type="submit" class="btn btn-primary w-100">Actualizar Contraseña</button>
            </form>

            <div class="text-center mt-3">
                <a href="/login">Volver a iniciar sesión</a>
            </div>
        </div>

    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    document.getElementById('password').addEventListener('input', function () {
        const password = this.value;
        const passwordHelp = document.getElementById('passwordHelp');
        const passwordSuggestion = document.getElementById('passwordSuggestion');

        // Verifica si la contraseña tiene al menos 8 caracteres
        if (password.length < 8) {
            passwordHelp.textContent = 'La contraseña debe tener al menos 8 caracteres.';
        } else if (/\s/.test(password)) {
            passwordHelp.textContent = 'La contraseña no debe contener espacios.';
        } else if (!/\d/.test(password)) {
            passwordHelp.textContent = 'La contraseña debe contener al menos un número.';
        } else if (!/[a-zA-Z]/.test(password)) {
            passwordHelp.textContent = 'La contraseña debe contener al menos una letra.';
        } else {
            passwordHelp.textContent = '';
        }

        // Sugerir una contraseña segura
        const strongPassword = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8,}$/;
        if (strongPassword.test(password)) {
            passwordSuggestion.textContent = 'Contraseña segura.';
        } else {
            passwordSuggestion.textContent = 'Sugerencia: Use letras mayúsculas, minúsculas, números y símbolos para mayor seguridad.';
        }
    });

    document.getElementById('resetForm').addEventListener('submit', function (e) {
        const password = document.getElementById('password').value;
        const passwordHelp = document.getElementById('passwordHelp');
        if (password.length < 8 || /\s/.test(password) || !/\d/.test(password) || !/[a-zA-Z]/.test(password)) {
            e.preventDefault(); // Prevenir el envío del formulario si la contraseña no es válida
            passwordHelp.textContent = 'Por favor, ingrese una contraseña válida.';
        }
    });
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
