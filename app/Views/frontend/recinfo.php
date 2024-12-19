<style>
    .card:hover {
        background-color: #005CAB;
        color: white;
        cursor: pointer;
    }
</style>



<div class="container my-5">
    <div class="p-5 text-center bg-body-tertiary rounded-3">
        <p class="lead">
            La Biblioteca de la Universidad Pedagógica Nacional es una biblioteca especializada, es decir; gestiona recursos de información principalmente para el aprendizaje, la docencia, la investigación y la formación continua.
        </p>
    </div>
</div>




<div class="container my-5">
    <!-- <div class="p-5" style="background-color: #04328C;"> -->
    <div class="p-5 text-center bg-body-secondary rounded-3">
        <h2 class="pb-2 border-bottom">Buscadores académicos</h2>

        <div class="row row-cols-1 row-cols-lg-5 align-items-stretch g-2 py-2">
            <?php foreach ($buscadoracademico as $index => $ba): ?>

                <div class="col">
                    <!-- <div class="card card-cover h-100 overflow-hidden text-bg-dark rounded-3 shadow-lg" style="background-image: url('<?= base_url('uploads/' . $ba['filename']); ?>');"> -->
                    <?php if (!empty($ba['enlace'])): ?>
                    <a href="<?= $ba['enlace']; ?>" target="_blank" class="text-decoration-none">
                        <?php endif; ?>
                        <div class="card h-100 rounded-3">
                            <div class="d-flex flex-column h-100 p-5 pb-3 text-shadow-1">
                                <h4 class="mb-4 display-8 lh-1 fw-bold"><?= $ba['titulo']; ?></h4>
                            </div>
                        </div>
                    </a>
                </div>
            <?php endforeach; ?>

        </div>

    </div>
    <!-- </div> -->
</div>





<div class="container my-5">
    <!-- <div class="p-5" style="background-color: #04328C;"> -->
    <div class="p-5 text-center bg-body-secondary rounded-3">
        <h2 class="pb-2 border-bottom">Gestores bibliográficos</h2>

        <div class="row row-cols-1 row-cols-lg-5 align-items-stretch g-2 py-2">
            <?php foreach ($gestorbibliografico as $index => $gb): ?>

                <div class="col">
                    <!-- <div class="card card-cover h-100 overflow-hidden text-bg-dark rounded-3 shadow-lg" style="background-image: url('<?= base_url('uploads/' . $gb['filename']); ?>');"> -->
                    <?php if (!empty($gb['enlace'])): ?>
                    <a href="<?= $gb['enlace']; ?>" target="_blank" class="text-decoration-none">
                        <?php endif; ?>
                        <div class="card h-100 rounded-3">
                            <div class="d-flex flex-column h-100 p-5 pb-3 text-shadow-1">
                                <h4 class="mb-4 display-8 lh-1 fw-bold"><?= $gb['titulo']; ?></h4>
                            </div>
                        </div>
                    </a>
                </div>
            <?php endforeach; ?>

        </div>

    </div>
    <!-- </div> -->
</div>





<div class="container my-5">
    <!-- <div class="p-5" style="background-color: #04328C;"> -->
    <div class="p-5 text-center bg-body-secondary rounded-3">
        <h2 class="pb-2 border-bottom">Traductores</h2>

        <div class="row row-cols-1 row-cols-lg-5 align-items-stretch g-2 py-2">
            <?php foreach ($traductor as $index => $t): ?>

                <div class="col">
                    <!-- <div class="card card-cover h-100 overflow-hidden text-bg-dark rounded-3 shadow-lg" style="background-image: url('<?= base_url('uploads/' . $t['filename']); ?>');"> -->
                    <?php if (!empty($t['enlace'])): ?>
                    <a href="<?= $t['enlace']; ?>" target="_blank" class="text-decoration-none">
                        <?php endif; ?>
                        <div class="card h-100 rounded-3">
                            <div class="d-flex flex-column h-100 p-5 pb-3 text-shadow-1">
                                <h4 class="mb-4 display-8 lh-1 fw-bold"><?= $t['titulo']; ?></h4>
                            </div>
                        </div>
                    </a>
                </div>
            <?php endforeach; ?>

        </div>

    </div>
    <!-- </div> -->
</div>





<!--
<div class="container my-5">
    <div class="p-5 text-center bg-body-secondary rounded-3">
            <h2 class="pb-2 border-bottom">Gestores bibliográficos</h2>

            <div class="row row-cols-1 row-cols-lg-5 align-items-stretch g-2 py-2">
                <?php foreach ($gestorbibliografico as $index => $gb): ?>

                    <div class="col">
                        <div class="card card-cover h-100 overflow-hidden text-bg-dark rounded-3 shadow-lg" style="background-image: url('<?= base_url('uploads/' . $gb['filename']); ?>');">
                        <?php if (!empty($gb['enlace'])): ?>
                        <a href="<?= $gb['enlace']; ?>" target="_blank" class="text-decoration-none">
                            <?php endif; ?>
                            <div class="card h-100 rounded-3">
                                <div class="d-flex flex-column h-100 p-5 pb-3 text-shadow-1">
                                    <h4 class="mb-4 display-8 lh-1 fw-bold"><?= $gb['titulo']; ?></h4>
                                </div>
                            </div>
                        </a>
                    </div>
                <?php endforeach; ?>

            </div>

        </div>
</div>
-->


<div class="b-example-divider"></div>