<?php include_once "../layout/header.php"?>

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Entradas de Productos</h1>
    <a href="index.php?opcion=registrarEntrada" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
        <i class="fas fa-plus fa-sm text-white-50"></i> Nueva Entrada
    </a>
</div>

<!-- Tabla de Entradas -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Listado de Entradas</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Producto</th>
                        <th>Fecha</th>
                        <th>Cantidad</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($entradas as $entrada): ?>
                    <tr>
                        <td><?= $entrada["ID"] ?></td>
                        <td><?= $entrada["producto"] ?></td>
                        <td><?= date('d/m/Y', strtotime($entrada["fecha"])) ?></td>
                        <td><?= $entrada["total"] ?></td>
                    </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<nav aria-label="Page navigation">
    <ul class="pagination justify-content-center">
        <?php if ($pagina > 1): ?>
            <li class="page-item">
                <a class="page-link" href="index.php?opcion=mostrarEntradas&pagina=<?= $pagina - 1 ?>">Anterior</a>
            </li>
        <?php endif; ?>

        <?php for ($i = 1; $i <= $totalPaginas; $i++): ?>
            <li class="page-item <?= ($i == $pagina) ? 'active' : '' ?>">
                <a class="page-link" href="index.php?opcion=mostrarEntradas&pagina=<?= $i ?>"><?= $i ?></a>
            </li>
        <?php endfor; ?>

        <?php if ($pagina < $totalPaginas): ?>
            <li class="page-item">
                <a class="page-link" href="index.php?opcion=mostrarEntradas&pagina=<?= $pagina + 1 ?>">Siguiente</a>
            </li>
        <?php endif; ?>
    </ul>
</nav>

<?php include_once "../layout/footer.php"?>

<style>
    .d-inline{
        display: inline-block;
    }
</style>