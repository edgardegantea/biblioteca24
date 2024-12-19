<?= $this->extend('frontend/layout/main'); ?>
<?= $this->section('content'); ?>


<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=DM+Serif+Display:ital@0;1&family=Montserrat:ital,wght@0,100..900;1,100..900&family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap"
      rel="stylesheet">

<style>
    .montserrat-fuente {
        font-family: "Montserrat", sans-serif;
        font-optical-sizing: auto;
        font-weight: 700;
        font-style: normal;
    }
    .filters-aside {
        background-color: #f8f9fa;
        padding: 20px;
        border-radius: 5px;
    }

    .container {
        display: flex;
    }

    .search-results {
        flex: 3;
    }

    aside {
        flex: 1;
        margin-right: 20px;
    }
</style>

<div class="container mt-5">

    <aside class="filters-aside">
        <h2>Filtrar Búsqueda</h2>
        <form method="get" action="/ruta/para/filtrar">
            <div class="mb-3">
                <label for="filtro-tipo" class="form-label">Tipo de archivo</label>
                <select class="form-select" id="filtro-tipo" name="tipo">
                    <option value="">Todos</option>
                    <option value="pdf">PDF</option>
                    <option value="doc">Documentos</option>
                    <option value="image">Imágenes</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="filtro-fecha-inicio" class="form-label">Rango de fechas</label>
                <div class="d-flex">
                    <input type="date" class="form-control me-2" id="filtro-fecha-inicio" name="fecha_inicio" placeholder="Desde">
                    <input type="date" class="form-control" id="filtro-fecha-fin" name="fecha_fin" placeholder="Hasta">
                </div>
            </div>


            <button type="submit" class="btn btn-primary">Aplicar filtros</button>
        </form>
    </aside>

    <div class="search-results">
        <h1>Resultados de la búsqueda</h1>

        <?php if ($resultados): ?>
            <div class="row">
                <?php foreach ($resultados as $resultado): ?>
                    <div class="mb-1">
                        <div class="card">
                            <div class="card-body">
                                <?php if ($resultado['tipo'] === 'application/pdf'): ?>
                                    <a href="/archivos/visualizar/<?= $resultado['id'] ?>"
                                       class="text-decoration-none montserrat-fuente"
                                       target="_self"><?= $resultado['nombre'] ?></a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <p>No se encontraron resultados.</p>
        <?php endif; ?>
    </div>

</div>

<?= $this->endSection() ?>
