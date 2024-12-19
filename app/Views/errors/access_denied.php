<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acceso No Autorizado</title>
    <meta http-equiv="refresh" content="5;url=<?= session()->get('redirect_url') ?>">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        #countdown {
            font-weight: bold;
            color: #dc3545;
        }
    </style>
    <script>
        let countdown = 5;
        let countdownElement;

        function startCountdown() {
            countdownElement = document.getElementById('countdown');
            countdownElement.textContent = countdown;

            const interval = setInterval(() => {
                countdown--;
                countdownElement.textContent = countdown;

                if (countdown <= 0) {
                    clearInterval(interval);
                }
            }, 1000);
        }
    </script>
</head>
<body class="bg-light" onload="startCountdown()">
    <div class="container d-flex justify-content-center align-items-center min-vh-100">
        <div class="card text-center" style="width: 600px;">
            <div class="card-body">
                <h2 class="card-title text-danger">ACCESO NO AUTORIZADO</h2>
                <p class="card-text">No tienes permiso para acceder a esta página.</p>
                <p class="card-text">Serás redirigido automáticamente en <span id="countdown">5</span> segundos...</p>
                <p class="card-text">Si no eres redirigido, haz clic <a href="<?= session()->get('redirect_url') ?>" class="link-primary">aquí</a>.</p>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
