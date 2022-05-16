<?php 

require 'config/conexion.php';

$db = new Conexion();
$con = $db->conectar();

$id = $_GET['id'];


$query =$con->prepare("DELETE FROM productos WHERE id=?");

if($query->execute([$id])){
    echo 'Registro eliminado';
} else {
    echo 'Error al eliminar el registro';
}
