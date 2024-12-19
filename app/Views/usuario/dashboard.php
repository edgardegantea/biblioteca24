<?= $this->extend('layout/mainUsuario'); ?>

<?= $this->section('content'); ?>


<style>
    .blog-header-logo:hover {
        text-decoration: none;
    }



    .flex-auto {
        flex: 0 0 auto;
    }

    .h-250 {
        height: 250px;
    }

    @media (min-width: 768px) {
        .h-md-250 {
            height: 250px;
        }
    }

    /* Pagination */
    .blog-pagination {
        margin-bottom: 4rem;
    }

    /*
 * Blog posts
 */
    .blog-post {
        margin-bottom: 4rem;
    }

    .blog-post-meta {
        margin-bottom: 1.25rem;
        color: #727272;
    }


    .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
    }

    @media (min-width: 768px) {
        .bd-placeholder-img-lg {
            font-size: 3.5rem;
        }
    }

    .b-example-divider {
        width: 100%;
        height: 3rem;
        background-color: rgba(0, 0, 0, .1);
        border: solid rgba(0, 0, 0, .15);
        border-width: 1px 0;
        box-shadow: inset 0 .5em 1.5em rgba(0, 0, 0, .1), inset 0 .125em .5em rgba(0, 0, 0, .15);
    }

    .b-example-vr {
        flex-shrink: 0;
        width: 1.5rem;
        height: 100vh;
    }

    .bi {
        vertical-align: -.125em;
        fill: currentColor;
    }

    .nav-scroller {
        position: relative;
        z-index: 2;
        height: 2.75rem;
        overflow-y: hidden;
    }

    .nav-scroller .nav {
        display: flex;
        flex-wrap: nowrap;
        padding-bottom: 1rem;
        margin-top: -1px;
        overflow-x: auto;
        text-align: center;
        white-space: nowrap;
        -webkit-overflow-scrolling: touch;
    }

    .btn-bd-primary {
        --bd-violet-bg: #712cf9;
        --bd-violet-rgb: 112.520718, 44.062154, 249.437846;

        --bs-btn-font-weight: 600;
        --bs-btn-color: var(--bs-white);
        --bs-btn-bg: var(--bd-violet-bg);
        --bs-btn-border-color: var(--bd-violet-bg);
        --bs-btn-hover-color: var(--bs-white);
        --bs-btn-hover-bg: #6528e0;
        --bs-btn-hover-border-color: #6528e0;
        --bs-btn-focus-shadow-rgb: var(--bd-violet-rgb);
        --bs-btn-active-color: var(--bs-btn-hover-color);
        --bs-btn-active-bg: #5a23c8;
        --bs-btn-active-border-color: #5a23c8;
    }

    .bd-mode-toggle {
        z-index: 1500;
    }

    .bd-mode-toggle .dropdown-menu .active .bi {
        display: block !important;
    }

    .card:hover {
        background-color: #007bff;
        /* Color de fondo azul al pasar el cursor */
        color: white;
        /* Color de texto blanco al pasar el cursor */
        cursor: pointer;
        /* Cambia el cursor a una mano para indicar que es clicable */
    }
</style>


<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfobject/2.2.11/pdfobject.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@docsearch/css@3">

<div class="container">
    <div class="">
        <div class="jumbotron p-4 p-md-5 mb-4 rounded text-body-emphasis bg-body-secondary mt-5">
            <div class="col-lg-12 px-0">
                <div class="input-group input-group-lg">
                    <input autofocus type="search" id="search-input" name="termino_busqueda" class="form-control" placeholder="Buscar en la base de datos..." aria-label="Buscar" aria-describedby="search-addon" />
                    <button type="button" class="btn btn-outline-primary">Buscar</button>
                </div>
            </div>
        </div>  


        <div id="resultados">
            <?php if (!empty($searchTerm)): ?> 
                <h2>Resultados de la Búsqueda para: <?= esc($searchTerm) ?></h2>

                <?php if ($searchResults): ?>
                    <div class="row"> 
                        <?php foreach ($searchResults as $result): ?>
                            <div class="col-md-6 mb-4">
                                <div class="card h-100">
                                    <div class="card-body">
                                        <h5 class="card-title"><?= esc($result['nombre']) ?></h5>
                                        <p class="card-text">Tipo: <?= esc($result['tipo']) ?></p>
                                        <?php if ($result['categoria_nombre']): ?>
                                            <p class="card-text">Categoría: <?= esc($result['categoria_nombre']) ?></p>
                                        <?php endif; ?>
                                    </div>
                                    <div class="card-footer">
                                        <a href="<?= base_url() . $result['ruta'] ?>" target="_blank" class="btn btn-link">Descargar</a> 
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php else: ?>
                    <p>No se encontraron resultados.</p>
                <?php endif; ?>
            <?php endif; ?>
        </div>

        <div class="row g-5">
            <div class="col-md-8">
                <article class="blog-post">
                        <?php if (!empty($archivos)): ?>
                            <h2 class="mb-5">Resultados de la Búsqueda</h2>
                            <ul class="list-unstyled">
                                <?php foreach ($archivos as $archivo): ?>
                                    <div class="card mb-3">
                                        <div class="card-body">
                                            <li class="">
                                                <h3><?= $archivo['nombre'] ?></h3>
                                                <p>Autores: <?= $archivo['tipo'] ?></p>
                                                <?php if (!empty($archivo['clasificacion_nombre'])): ?>
                                                    <a href="<?= $archivo['clasificacion_nombre'] ?>" target="_blank" class="btn btn-link">Ver recurso completo</a>
                                                <?php endif; ?>
                                            </li>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </ul>
                        <?php endif; ?>
                </article>

                <nav class="blog-pagination" aria-label="Pagination">
                    <a class="btn btn-outline-primary rounded-pill" href="#">Older</a>
                    <a class="btn btn-outline-secondary rounded-pill disabled" aria-disabled="true">Newer</a>
                </nav>

            </div>

            <div class="col-md-4">
            </div>

        </div>
    </div>
</div>


<script src="<?= base_url('js/bootstrap.bundle.min.js') ?>"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function()  
 {
        var searchInput = $('#search-input');  

        var resultadosDiv = $('#resultados');

        searchInput.on('keypress', function(e) {
            if (e.which === 13) { 
                realizarBusqueda();
            }
        });

        $('button[type="button"]').click(function() {
            realizarBusqueda();
        });

        function realizarBusqueda() {
            var searchTerm = searchInput.val();

            if (searchTerm.trim() !== '') {
                $.ajax({
                    url: '/usuario/dashboard', 
                    method: 'POST',
                    data: {
                        termino_busqueda: searchTerm
                    },
                    success: function(response) {
                        console.log(response);

                        resultadosDiv.empty();

                        if (response.length > 0) {
                            var resultadosHTML = '<h2>Resultados de la Búsqueda</h2><div class="row">';

                            $.each(response, function(index, archivo) {
                                resultadosHTML += `
                                <div class="col-md-6 mb-4">
                                    <div class="card h-100">
                                        <div class="card-body">
                                            <h5 class="card-title">${archivo.nombre}</h5>
                                            <p class="card-text">Tipo: ${archivo.tipo}</p>
                                            ${archivo.categoria_nombre ? `<p class="card-text">Categoría: ${archivo.categoria_nombre}</p>` : ''} 
                                        </div>
                                        <div class="card-footer">
                                            <a href="<?= base_url() ?>${archivo.ruta}" target="_blank" class="btn btn-link">Descargar</a>
                                        </div>
                                    </div>
                                </div>
                            `;
                            });

                            resultadosHTML += '</div>';
                            resultadosDiv.html(resultadosHTML);
                        } else {
                            resultadosDiv.html('<p>No se encontraron resultados.</p>');
                        }
                    }
                });
            } else {
                resultadosDiv.empty();
            }
        }
    });
</script>

<?= $this->endSection(); ?>