<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>


<h2>Seleccionar o registrar palabra clave</h2>

<form action="<?= base_url('admin/recursos/step3') ?>" method="post">

    <div class="form-group">
        <label>Palabras clave disponibles:</label>
        <select name="tag_id" class="form-control" id="tag_id">
            <?php foreach ($tags as $tag): ?>
                <option value="<?= $tag['id'] ?>"><?= $tag['nombre'] ?></option>
            <?php endforeach; ?>
            <option value="nueva">Agregar nueva palabra clave</option>
        </select>
    </div>

    <div class="mt-2">
        <div id="nueva-tag" class="">
            <label>Palabra clave:</label>
            <input class="form-control" type="text" name="nueva_tag" placeholder="Palabra clave">
        </div>
    </div>

    <div class="mt-2">
        <button class="btn btn-primary" type="submit">Continuar</button>
    </div>
    
</form>


<script>
    document.getElementById('tag_id').addEventListener('change', function() {
        const nuevaTagDiv = document.getElementById('nueva-tag');
        nuevaTagDiv.style.display = this.value === 'nueva' ? 'block' : 'none';
    });
</script>



<?= $this->endSection(); ?>