<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>


<h2>Seleccionar o registrar género</h2>

<form action="<?= base_url('admin/recursos/step2') ?>" method="post">
    <!-- Selección de categorías existentes -->


    <div class="form-group">
        <label>Géneros disponibles:</label>
        <select name="genero_id" class="form-control" id="genero_id">
            <?php foreach ($generos as $genero): ?>
                <option value="<?= $genero['id'] ?>"><?= $genero['nombre'] ?></option>
            <?php endforeach; ?>
            <option value="nueva">Agregar nuevo género</option>
        </select>
    </div>

    <div class="mt-2">
        <div id="nuevo-genero" class="">
            <label>Nombre del nuevo género:</label>
            <input class="form-control" type="text" name="nuevo_genero" placeholder="Nombre del nuevo género">
        </div>
    </div>

    <div class="mt-2">
        <button class="btn btn-primary" type="submit">Continuar</button>
    </div>
    
</form>


<script>
    document.getElementById('genero_id').addEventListener('change', function() {
        const nuevaGeneroDiv = document.getElementById('nuevo-genero');
        nuevaGeneroDiv.style.display = this.value === 'nueva' ? 'block' : 'none';
    });
</script>



<?= $this->endSection(); ?>