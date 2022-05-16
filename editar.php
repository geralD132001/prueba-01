<?php
require 'config/conexion.php';

$db = new Conexion();
$con = $db->conectar();

$id = $_GET['id'];
$estado = 1;

$query = $con->prepare("SELECT descripcion, cantidad, inventariable, stock, precio_compra, precio_venta FROM productos WHERE id = :id AND estado=:estado");
$query->execute([':id' => $id, 'estado' => $estado]);
$num = $query->rowCount();
if ($num > 0) {
    $row = $query->fetch(PDO::FETCH_ASSOC);
} else {
    header("Location: index.php");
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

<body class="py-4">
    <main class="container">
        <div class="row">
            <div class="col">
                <h4>Nuevo registro</h4>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col">
                <form class="row g-3" method="post" action="insertar.php" autocomplete="off">
                    <input type="hidden" id="id" name="id" value="<?php echo $id; ?>">
                    <div class="col-md-4">
                        <label for="descripcion" class="form-label">Descripción</label>
                        <input type="text" id="descripcion" name="descripcion" class="form-control" value="<?php echo $row['descripcion']; ?>" required autofocus>
                    </div>

                    <div class="col-md-8">
                        <label for="cantidad" class="form-label">Cantidad</label>
                        <input type="number" id="cantidad" name="cantidad" class="form-control" value="<?php echo $row['cantidad']; ?>" required>
                    </div>

                    <h5>Inventario</h5>

                    <div class="col-md-12">
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="inventariable" name="inventariable" value="1" <?php
                                                                                                                                if ($row['inventariable']) {
                                                                                                                                    echo 'checked';
                                                                                                                                }
                                                                                                                                ?>>
                            <label for="inventariable" class="form-check-label">Usa inventario</label>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <label for="stock" class="form-label">Existencias</label>
                        <input type="number" id="stock" name="stock" class="form-control" value="<?php echo $row['stock']; ?>">
                    </div>


                    
                    <div class="col-md-4">
                        <label for="precio_compra" class="form-label">Precio Compra</label>
                        <input type="number" id="precio_compra" name="precio_compra" class="form-control" value="<?php echo $row['precio_compra']; ?>">
                    </div>

                    <div class="col-md-4">
                        <label for="precio_venta" class="form-label">Precio venta</label>
                        <input type="number" id="precio_venta" name="precio_venta" class="form-control" value="<?php echo $row['precio_venta']; ?>">
                    </div>


                    <div class="col-md-12">
                        <a class="btn btn-secondary" href="index.php">Regresar</a>
                        <button type="submit" class="btn btn-success" name="registro">Guardar</button>
                    </div>
                </form>
            </div>
        </div>

    </main>
</body>
<script src="public/js/bootstrap.bundle.min.js"></script>

</html>