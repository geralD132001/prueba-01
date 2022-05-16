<?php

require 'config/conexion.php';

// PDO permite conectarte a cualquier base de datos

$db = new Conexion();
$con = $db->conectar();

$estado = 1;

$comando = $con->prepare("SELECT id, descripcion, cantidad, stock, precio_compra, precio_venta FROM productos WHERE estado=:mi_activo");

$comando->execute(['mi_activo' => $estado]);

$resultado = $comando->fetchAll(PDO::FETCH_ASSOC);


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="public/css/bootstrap.min.css">

    <title>Prueba 01</title>
</head>

<body class="py-3">
    <main class="container">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="#"></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="#">HOME <span class="sr-only"></span></a>
                    </li>
            </div>
        </nav>

        <br>

        <div class="row">
            <div class="col">
                <h4>Productos
                    <a href="nuevo.php" class="btn btn-success">Nuevo</a>
                </h4>
            </div>
        </div>

        <div class="row py-3">
            <div class="col">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Descripción</th>
                            <th>Cantidad</th>
                            <th>Stock</th>
                            <th>Precio Compra</th>
                            <th>Precio Venta</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                        foreach ($resultado as $row) {
                        ?>
                            <tr>
                                <td><?php echo $row['id'] ?></td>
                                <td><?php echo $row['descripcion'] ?></td>
                                <td><?php echo $row['cantidad'] ?></td>
                                <td><?php echo $row['stock'] ?></td>
                                <td><?php echo " S/ " . $row['precio_compra'] ?></td>
                                <td><?php echo " S/ " . $row['precio_venta']?></td>
                                <td><a href="editar.php?id=<?php echo $row['id'] ?>" class="btn btn-warning">Editar</a></td>
                                <td><a href="eliminar.php?id=<?php echo $row['id'] ?>" class="btn btn-danger">Elimnar</a></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </main>
</body>
<script src="public/js/bootstrap.bundle.min.js"></script>

</html>