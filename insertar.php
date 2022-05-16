<?php

require 'config/conexion.php';


$db = new Conexion();
$con = $db->conectar();

$correcto = false;

if (isset($_POST['id'])) {
    $id   = $_POST['id'];
    $descripcion = $_POST['descripcion'];
    $cantidad = $_POST['cantidad'];
    $stock = $_POST['stock'];
    $inventariable = isset($_POST['inventariable']) ? $_POST['inventariable'] : 0;
    $precio_compra = $_POST['precio_compra'];
    $precio_venta = $_POST['precio_venta'];


    if ($stock == '') {
        $stock = 0;
    }

    $query = $con->prepare("UPDATE productos SET descripcion =?, cantidad=?, stock=?, inventariable=?, precio_compra=?, precio_venta=? WHERE id=?");
    $resultado = $query->execute(array($descripcion, $cantidad, $inventariable, $stock, $precio_compra, $precio_venta, $id));

    if ($resultado) {
        $correcto = true;
    }
} else {
    $descripcion = $_POST['descripcion'];
    $cantidad = $_POST['cantidad'];
    $stock = $_POST['stock'];
    $inventariable = isset($_POST['inventariable']) ? $_POST['inventariable'] : 0;
    $precio_compra = $_POST['precio_compra'];
    $precio_venta = $_POST['precio_venta'];


    if ($stock == '') {
        $stock = 0;
    }

    $query = $con->prepare("INSERT INTO productos (descripcion,cantidad,inventariable,stock,precio_compra, precio_venta, estado) 
    VALUES (:descr, :cant, :inv, :sto, :pc, :pv, 1 )");

    $resultado = $query->execute(array('descr' => $descripcion, 'cant' => $cantidad, 'inv' => $inventariable, 'sto' => $stock, 'pc' => $precio_compra, 'pv' => $precio_venta));

    if ($resultado) {
        $correcto = true;
        echo $con->lastInsertId();
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="public/css/bootstrap.min.css">

</head>

<body class="py-3">
    <main class="container">
        <div class="row">
            <div class="col">
                <?php if ($correcto) { ?>
                    <h3>Registro guardado</h3>
                <?php } else { ?>
                    <h3>Error al guardar</h3>
                <?php } ?>
            </div>

            <div class="row">
                <div class="col">
                    <a class="btn btn-primary" href="index.php">Regresar</a>
                </div>
            </div>

    </main>

</body>
<script src="public/js/bootstrap.bundle.min.js"></script>

</html>