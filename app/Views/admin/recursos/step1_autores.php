<!-- Cargar jQuery, Bootstrap, y Select2 CSS y JS -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet"/>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

<!-- Estilos personalizados para integrar Select2 con Bootstrap 5 -->
<style>
    /* Ajusta el contenedor de Select2 para Bootstrap 5 */
    .select2-container .select2-selection--single,
    .select2-container .select2-selection--multiple {
        padding: 0.5rem 0.75rem;
        height: calc(2em + 0.5rem + 10px); /* Altura estándar de Bootstrap 5 */
        border: 1px solid #ced4da;
        border-radius: 0.25rem;
    }

    /* Ajuste de la posición y tamaño del icono de dropdown */
    .select2-container--default .select2-selection--single .select2-selection__arrow {
        top: 50%;
        transform: translateY(-50%);
        right: 0.75rem;
    }

    /* Asegurar que Select2 ocupe el 100% del ancho */
    .select2-container {
        width: 100% !important;
    }

    /* Ajusta la altura del texto en Select2 */
    .select2-container .select2-selection__rendered {
        line-height: 1.5 !important; /* Alineación de texto para coincidir con Bootstrap 5 */
    }
</style>

<div class="container">

    <h2>Seleccionar o Registrar Autores</h2>
    <form action="<?= base_url('admin/recursos/step1') ?>" method="post">
        <div class="row">
            <select id="select-autores" class="js-example-basic-multiple form-control" name="autores[]" multiple="multiple">
                <option value="">Seleccione a los autores</option>
                <?php foreach ($autores as $autor): ?>
                    <option value="<?= $autor['id'] ?>"><?= $autor['nombre'] ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="form-group mt-3">
            <label>Agregar Nuevos Autores:</label>
            <div id="nuevos-autores">
                <input class="form-control" type="text" name="nuevos_autores[]" placeholder="Nombre del autor">
            </div>
        </div>

        <br>
        <button class="btn btn-secondary" type="button" onclick="agregarCampoAutor()">Agregar otro autor</button>
        <button class="btn btn-primary" type="submit">Continuar</button>
    </form>

    <script type="text/javascript">
        $(document).ready(function () {
            // Inicializar Select2 con el tema clásico y ajuste de Bootstrap 5
            $('#select-autores').select2({
                theme: 'classic',
                placeholder: "Seleccione la asignatura",
                allowClear: true,
                width: 'resolve'
            });
        });

        function agregarCampoAutor() {
            const nuevosAutoresDiv = document.getElementById('nuevos-autores');
            const input = document.createElement('input');
            input.classList.add('form-control', 'mt-2');
            input.type = 'text';
            input.name = 'nuevos_autores[]';
            input.placeholder = 'Nombre del autor';
            nuevosAutoresDiv.appendChild(input);
        }
    </script>
</div>
