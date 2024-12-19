<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>


<h2>Seleccionar o registrar editorial</h2>

<form action="<?= base_url('admin/recursos/step4') ?>" method="post">


    <div class="form-group">
        <label>Editoriales disponibles:</label>
        <select name="editorial_id" class="form-control" id="editorial_id">
            <?php foreach ($editoriales as $editorial): ?>
                <option value="<?= $editorial['id'] ?>"><?= $editorial['nombre'] ?></option>
            <?php endforeach; ?>
            <option value="nueva">Agregar nueva editorial</option>
        </select>
    </div>

    <div class="mt-2">
        <div id="nueva-editorial" class="">
            <label>Nombre de la nueva editorial:</label>
            <input class="form-control" type="text" name="nueva_editorial" placeholder="Nombre de la nueva editorial">
        </div>
    </div>

    <div class="mt-2">
        <button class="btn btn-primary" type="submit">Continuar</button>
    </div>
    
</form>


<script>
    document.getElementById('editorial_id').addEventListener('change', function() {
        const nuevaEditorialDiv = document.getElementById('nueva-editorial');
        nuevaEditorialDiv.style.display = this.value === 'nueva' ? 'block' : 'none';
    });
</script>



<?= $this->endSection(); ?>