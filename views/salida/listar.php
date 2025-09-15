<?php include_once "../layout/header.php"?>

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Salidas de Productos</h1>
    <a href="index.php?opcion=registrarSalida" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
        <i class="fas fa-minus fa-sm text-white-50"></i> Nueva Salida
    </a>
</div>

<!-- Tabla de Salidas -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Listado de Salidas</h6>
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
                    <?php foreach ($salidas as $salida): ?>
                    <tr>
                        <td><?= $salida["ID"] ?></td>
                        <td><?= $salida["producto"] ?></td>
                        <td><?= date('d/m/Y', strtotime($salida["fecha"])) ?></td>
                        <td><?= $salida["total"] ?></td>
                    </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
</div>


<?php include_once "../layout/footer.php"?>

<style>
    .d-inline{
        display: inline-block;
    }
</style>